import * as H from "history";

export interface Routable {
    id: number | string;
}

export type RouteParam = Routable | string | number | boolean;

export type RouteParams = { [key: string]: RouteParam } | RouteParam[];

export interface QueryParams {
    [key: string]: QueryParams | string | number | boolean;
}

export type RouteParamsWithQueryOverload =
    | RouteParams
    | {
          _query: QueryParams;
      };

export interface Route {
    uri: string;
    methods: Array<
        "GET" | "HEAD" | "POST" | "PATCH" | "PUT" | "OPTIONS" | "DELETE"
    >;
    domain?: null | string | undefined;
}

export interface Config {
    routes: {
        [key: string]: Route;
    };
    url: string;
    port?: number | null | undefined;
    location?: H.Location;
    defaults: {
        [key: string]: string | number;
    };
}

export class Router extends String {
    current(): string | undefined;
    current(name: string, params?: RouteParamsWithQueryOverload): boolean;

    check(name: string): boolean;

    has(name: string): boolean;

    get params(): RouteParams;

    toString(): string;

    valueOf(): string;
}

declare function route(
    name?: undefined,
    params?: RouteParamsWithQueryOverload | RouteParam,
    absolute?: boolean,
    config?: Config
): Router;

declare function route(
    name: string,
    params?: RouteParamsWithQueryOverload | RouteParam,
    absolute?: boolean,
    config?: Config
): string;

declare global {
    interface Window {
        route: route;
    }
}

declare module "@vue/runtime-core" {
    interface ComponentCustomProperties {
        route: route;
    }
}
