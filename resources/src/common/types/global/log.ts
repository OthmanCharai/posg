import type { Users } from '@common/types/users';

export interface AuditLog {
  id: number;
  user_id: string;
  log_datetime: string;
  table_name: string;
  log_type: 'create' | 'update' | 'delete';
  request_info: RequestInfo;
  data: Data;
  current_data: Data | null;
  humanize_datetime: string;
  user: Users;
}

interface RequestInfo {
  ip: string;
  user_agent: string;
}

interface Data {
  id: string;
  name: string;
  created_at: string;
  updated_at: string;
}

export interface CreateAuditLog {
  id?: number;
  user_id: string | null;
  table_name: string | null;
  log_type: 'create' | 'update' | 'delete' | null;
}
