export function createLengthBasedSorter <T>(data: T[], key: keyof T) {
  return (a: T, b: T) => {
    const aValue = String(a[key]);
    const bValue = String(b[key]);
    if (aValue === String(data[0][key]) || bValue === String(data[0][key])) {
      return 0;
    }
    return aValue.length - bValue.length;
  };
};

export function createNumericSorter <T>(key: keyof T) {
  return (a: T, b: T) => {
    const aValue = Number(a[key]);
    const bValue = Number(b[key]);
    return aValue - bValue;
  };
};

export function createDateSorter <T>(key: keyof T) {
  return (a: T, b: T) => {
    const aValue = new Date(a[key] as unknown as string).getTime();
    const bValue = new Date(b[key] as unknown as string).getTime();
    return aValue - bValue;
  };
};
