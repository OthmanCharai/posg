<?php

namespace App\src\Domain\Media;

use App\src\Domain\Media\Exceptions\FileDeleteFromS3FailedException;
use App\src\Domain\Media\Exceptions\FileUploadToS3FailedException;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;

class MediaService
{
    private Filesystem $storage;

    public function __construct(
        private readonly Repository $repository,
        private readonly FilesystemManager $filesystemManager
    ) {
        $this->storage = $this->filesystemManager->disk($this->repository->get('filesystems.disks.s3.driver'));
    }

    public function get(string $filename): array
    {
        return [
            'name' => $filename,
            'link' => $this->url($filename),
        ];
    }

    /**
     * @param string $filename
     *
     * @return string|null
     */
    public function url(string $filename): ?string
    {
        return $this->storage->url($filename);
    }

    /**
     * Generate a temporary URL for a private S3 object
     *
     * @param string $filename
     * @param int $expirationTimeInSeconds
     *
     * @return string|null
     */
    public function generateTemporaryUrl(string $filename, int $expirationTimeInSeconds = 60): ?string
    {
        return $this->storage->temporaryUrl(
            $filename,
            now()->addSeconds($expirationTimeInSeconds)
        );
    }

    /**
     * @throws FileUploadToS3FailedException
     */
    public function save(string $id, UploadedFile $file, string $folderName = 'uploads'): string
    {
        try {
            $filename = sprintf(
                "%s/%s_%s_%s.%s",
                $folderName,
                $id,
                $file->getClientOriginalName(),
                uuid_create(),
                $file->getClientOriginalExtension()
            );

            $this->storage->put(
                $filename,
                $file->getContent(),
            );

            return $filename;
        } catch (\Throwable $e) {
            throw new FileUploadToS3FailedException();
        }
    }

    /**
     * @throws FileDeleteFromS3FailedException
     */
    public function delete(string $filePath = null): bool
    {
        if (is_null($filePath)) {
            return false;
        }
        try {
            $this->storage->delete($filePath);

            return true;
        } catch (\Throwable $e) {
            throw new FileDeleteFromS3FailedException($filePath);
        }
    }

    public function getFileContent(string $filePath): ?string
    {
        return $this->storage->get($filePath);
    }

    public function getContentType($path): string
    {
        return match ($this->storage->mimeType($path)) {
            'svg' => 'image/svg+xml',
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            default => 'application/octet-stream',
        };
    }
}