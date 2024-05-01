import type { ThemeConfig } from "ant-design-vue/es/config-provider/context";

// Overrides Antdv styles
export const customStyle: ThemeConfig = {
  // global style:
  token: {
    colorPrimary: "#001656",
    colorPrimaryBg: "#e0efff",
    fontFamily: ["Nunito", "sans-serif"] as any,
  },

  // Custom components
  components: {
  }
};
