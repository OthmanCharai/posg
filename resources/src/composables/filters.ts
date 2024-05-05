// Dropdown filter
export function dropDownFilter(input: string, option: any) {
  return option.label.toLowerCase().includes(input.toLowerCase());
}
