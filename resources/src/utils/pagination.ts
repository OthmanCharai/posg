import type { PaginatedResponse, PaginationMetadata } from '@common/types/global/pagination';

/**
 * Returns the pagination metadata from a paginated response.
 */
export function extractPaginatorObject<T>(metadata: PaginatedResponse<T>): PaginationMetadata {
  /**
   * Destructuring the metadata object and then spreading
   * the rest of the properties in a new object.
   *
   * This way we end up with the same given object minus
   * the `data` field.
   */

  const { data, ...paginationMetadata } = metadata;

  return paginationMetadata;
}
