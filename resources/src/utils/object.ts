/**
 * Creates a deep clone of the specified object.
 */
export function deepClone<T>(data: unknown): T {
  if (typeof data !== 'object' || data === null) {
    return data as T;
  }

  return JSON.parse(JSON.stringify(data)) as T;
}
