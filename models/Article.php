<?php

/**
 * Entité Article, un article est défini par les champs
 * id, id_user, title, content, date_creation, date_update.
 */
class Article extends AbstractEntity
{
    private int $idUser;
    private string $title = '';
    private string $content = '';
    private int $views;
    private ?DateTime $dateCreation = null;
    private ?DateTime $dateUpdate = null;
    private ?int $nbComments = null;

    /**
     * Setter pour le nombre de commentaires.
     */
    public function setNbComments(int $nbComments): void
    {
        $this->nbComments = $nbComments;
    }

    /**
     * Getter pour le nombre de commentaires.
     */
    public function getNbComments(): int
    {
        return $this->nbComments;
    }

    /**
     * Setter pour le nombre de vues.
     */
    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    /**
     * Getter pour le nombre de vues.
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * Setter pour l'id de l'utilisateur.
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * Setter pour le titre.
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter pour le contenu.
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     *
     * @param int $length : le nombre de caractères à retourner.
     *                    Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     *                    Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     */
    public function getContent(int $length = -1): string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= '...';
            }

            return $content;
        }

        return $this->content;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     *
     * @param string $format : le format pour la convertion de la date si elle est une string.
     *                       Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     */
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    /**
     * Getter pour la date de création au format string.
     */
    public function getDateCreationString(): string
    {
        return $this->dateCreation->format('d/m/Y H:i:s');
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     *
     * @param string $format : le format pour la convertion de la date si elle est une string.
     *                       Par défaut, c'est le format de date mysql qui est utilisé.
     */
    public function setDateUpdate(string|DateTime|null $dateUpdate, string $format = 'Y-m-d H:i:s'): void
    {
        if (is_string($dateUpdate)) {
            $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
        }
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * Getter pour la date de mise à jour.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime ou null
     * si la date de mise à jour n'a pas été définie.
     */
    public function getDateUpdate(): ?DateTime
    {
        return $this->dateUpdate;
    }

    /**
     * Getter pour la date de mise à jour au format string.
     */
    public function getDateUpdateString(): string
    {
        if ($this->dateUpdate) {
            return $this->dateUpdate->format('d/m/Y H:i:s');
        }

        return '';
    }
}
