export function lengthSorter <T>(key: keyof T) {
  return (a: T, b: T) => {
    const aValue = String(a[key]);
    const bValue = String(b[key]);

    return aValue.length - bValue.length;
  };
};

export function numericSorter <T>(key: keyof T) {
  return (a: T, b: T) => {
    const aValue = Number(a[key]);
    const bValue = Number(b[key]);

    return aValue - bValue;
  };
};

export function dateSorter <T>(key: keyof T) {
  return (a: T, b: T) => {
    const aValue = new Date(a[key] as unknown as string).getTime();
    const bValue = new Date(b[key] as unknown as string).getTime();

    return aValue - bValue;
  };
};
