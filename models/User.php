<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */
class User extends AbstractEntity
{
    private string $login;
    private string $password;
    private string $role;

    /**
     * Setter pour le login.
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * Getter pour le login.
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Setter pour le password.
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Setter pour le role.
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Getter pour le role.
     */
    public function getRole(): string
    {
        return $this->role;
    }
}
