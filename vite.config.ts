import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';
import path from 'path';
import { AntDesignVueResolver } from 'unplugin-vue-components/resolvers';


export default defineConfig({
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './resources/'),
      "@utils": path.resolve(__dirname, './resources/src/utils/'),
      "@pages": path.resolve(__dirname, './resources/src/pages/'),
      "@common": path.resolve(__dirname, './resources/src/common/'),
      "@stores": path.resolve(__dirname, './resources/src/stores/')
    },
  },

  plugins: [
    laravel({
        input: ['resources/src/main.ts'],
        refresh: true,
    }),

    Vue({
      include: [/\.vue$/],
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: true,
        },
      },
    }),

    AutoImport({
      imports: ['vue'],
      dts: 'resources/src/auto-imports.d.ts',
      vueTemplate: true,
    }),

    Components({
      dirs: ['resources/src/components'],
      extensions: ['vue'],
      include: [/\.vue$/, /\.vue\?vue/],
      dts: 'resources/src/components.d.ts',
      resolvers: [
        AntDesignVueResolver({
          importStyle: false, // css in js
        }),
      ],
    }),
  ],

  build: {
    sourcemap: false,
    minify: true,
    cssCodeSplit: true,
  },

  server: {
    host: '0.0.0.0',
    hmr: { host: '0.0.0.0' },
  },
});
