<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Filter\EmailFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={
 *      "normalization_context"={"groups"={"client:read"}}
 *     },
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @ApiFilter(EmailFilter::class, properties={"contact.email":"partial"})
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"client:read"})
     * @ORM\OneToOne(targetEntity="App\Entity\ClientContact", cascade={"persist", "remove"})
     */
    private $contact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getContact(): ?ClientContact
    {
        return $this->contact;
    }

    public function setContact(?ClientContact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
