<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArchiveRepository")
 * @Vich\Uploadable
 */
class Archive
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // ... other fields

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="archive", fileNameProperty="archiveName", size="archiveSize")
     * 
     * @var File|null
     */
    private $archiveFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $archiveName;

    /**
     * @ORM\Column(type="string")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var string|null
     */
    private $archiveTitle;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $archiveSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $archiveFile
     */
    public function setArchiveFile(?File $archiveFile = null): void
    {
        $this->archiveFile = $archiveFile;

        if (null !== $archiveFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            var_dump($this->archiveFile);
            $this->updatedAt = new \DateTimeImmutable();
            $this->archiveSize = $archiveFile->getSize();
        }
    }

    public function getArchiveFile(): ?File
    {
        return $this->archiveFile;
    }

    public function setArchiveName(?string $archiveName): void
    {
        $this->archiveName = $archiveName;
    }

    public function getArchiveName(): ?string
    {
        return $this->archiveName;
    }

    public function setArchiveTitle(string $archiveTitle): self
    {
        $this->archiveTitle = $archiveTitle;

        return $this;
    }

    public function getArchiveTitle(): ?string
    {
        return $this->archiveTitle;
    }

    public function setArchiveSize(?int $archiveSize): void
    {
        $this->archiveSize = $archiveSize;
    }

    public function getArchiveSize(): ?int
    {
        return $this->archiveSize;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
