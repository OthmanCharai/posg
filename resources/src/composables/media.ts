export async function imageUrlToFile(url: string, filename: string) {
  try {
      const response = await fetch(url);
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      const blob = await response.blob();
      const fileExtention = blob.type === 'image/jpeg' ? '.jpeg' : blob.type === 'image/png' ? '.png' : '';
      const file = new File([blob], `${filename}${fileExtention}`, {
          type: blob.type,
          lastModified: new Date().getTime()
      });
      return file;
  } catch (error) {
      console.error('Error fetching and converting image:', error);
  }
}
