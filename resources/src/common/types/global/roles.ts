export interface Roles {
  id?: string;
  name: string;
  description: string;
  permissions: number | null | [];
}

type PermissionMap = { [key: number]: string };

export interface Permissions {
  [key: string]: PermissionMap | { [key: string]: PermissionMap };
}

export interface MappedPermission {
  id: number;
  type: string;
  name: string;
  icon: string;
}
