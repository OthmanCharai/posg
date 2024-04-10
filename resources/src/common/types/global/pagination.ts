export interface PaginationMetadata {
  total: number // Total number of items in the collection
  first_page_url: string // URL to the first page
  last_page_url: string | null // URL to the last page
  next_page_url: string | null // URL to the next page
  prev_page_url: string | null // URL to the previous page
  path: string // Href to the current page (without the query string)
  current_page: number // Current active page number
  last_page: number // Last page number
  per_page: number // Number of items per page
  from: number // Index of the first item on the current page relative to the entire collection (n+1)
  to: number // Index of the last item on the current page relative to the entire collection (n+1)
}

export interface PaginatedResponse<T> extends PaginationMetadata {
  data: T[] // Data to display
}

export interface AntPagination {
  current: number,
  pageSize: number,
  total: number
}
