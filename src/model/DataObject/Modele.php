<?php

namespace App\Fakex\model\DataObject;
/**
 * Cette classe simule un object modele
 *
 * <p>
 * L'objet modéle est crée avec l'information récoltée de notre Base De Données
 * C'est ainsi qu'on connecte notre BD au programme PHP
 * </p>
 */
class Modele
{
    public int|null $idModele;
    public string $nom;
    public int $prix;
    public string $creator;
    public string $imageUrl;
    public string $genre;

    public string $minSize;
    public string $maxSize;
    public int $quantity;

    /**
     * @param int|null $idModele
     * @param string $nom
     * @param int $prix
     * @param string $creator
     * @param string $imageUrl
     * @param string $genre
     * @param string $minSize
     * @param string $maxSize
     * @param int $quantity
     */
    public function __construct(?int $idModele, string $nom, int $prix, string $creator, string $imageUrl,  string $minSize, string $maxSize, string $genre,int $quantity)
    {
        $this->idModele = $idModele;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->creator = $creator;
        $this->imageUrl = $imageUrl;
        $this->genre = $genre;
        $this->minSize = $minSize;
        $this->maxSize = $maxSize;
        $this->quantity = $quantity;
    }


    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getCreator(): string
    {
        return $this->creator;
    }

    /**
     * @return int
     */
    public function getIdModele(): int
    {
        return $this->idModele;
    }

    /**
     * @return int
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    /**
     * @return Image
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @return MinSize as String
     */
    public function getMinSize(): string
    {
        return $this->minSize;
    }

    /**
     * @return MaxSize as String
     */
    public function getMaxSize(): string
    {
        return $this->maxSize;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }



    public function modeleAsJson(): array
    {
        return [
            'nom' => $this->nom,
            'prix' => $this->prix,
            'creator' => $this->creator,
            'imageUrl' => $this->imageUrl

        ];
    }




}