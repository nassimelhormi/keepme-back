<?php

namespace KeepMe\Entities;

use Doctrine\ORM\EntityManager;
use KeepMe\Utils\Doctrine\AutoIncrementId;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="KeepMe\Repositories\UserRepository")
 * @Table(name="user")
 */
class User implements \JsonSerializable
{
    use AutoIncrementID;

    /**
     * @Column(type="string", name="firstname", length=45, nullable=false)
     */
    protected $firstname;

    /**
     * @Column(type="string", name="lastname", length=45, nullable=false)
     */
    protected $lastname;

    /**
     * @Column(type="string", name="email", length=45, nullable=false)
     */
    protected $email;

    /**
     * @Column(type="string", name="password", length=45, nullable=false)
     */
    protected $password;

    /**
     * @Column(type="float", name="longitude", length=45, nullable=false)
     */
    protected $longitude;

    /**
     * @Column(type="float", name="latitude", length=45, nullable=false)
     */
    protected $latitude;

    /* ------------ GETTERS ------------ */

    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the value of firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Gets the value of lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

        /**
     * Gets the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets the value of longitude.
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Gets the value of latitude.
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /* ------------ SETTERS ------------ */

    /**
     * Sets the value of firstname.
     *
     * @param string $firstname the firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Sets the value of lastname.
     *
     * @param string $lastname the lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Sets the value of email.
     *
     * @param string $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Sets the value of password.
     *
     * @param string $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    /**
     * Sets the value of longitude.
     *
     * @param float $longitude the longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Sets the value of latitude.
     *
     * @param float $latitude the latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }



    /* ------------ UTILS ------------ */

    public function toArray()
    {
        return [
            "id"        => $this->getId(),
            "firstname" => $this->getFirstname(),
            "lastname"  => $this->getLastname(),
            "email"     => $this->getEmail(),
            "longitude" => $this->getLongitude(),
            "latitude"  => $this->getLatitude()
        ];
    }

    public function toIndex()
    {
        return $this->toArray();
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function setProperties(array $data)
    {
        $mandatory_fields = [
            "id",
            "firstname",
            "lastname",
            "login",
            "email",
            "password",
            "longitude",
            "latitude"
        ];

        $fields = array_intersect(
            $mandatory_fields,
            array_keys($data)
        );

        foreach ($fields as $field) {
            $setterName = 'set' . ucfirst($field);
            if (method_exists($this, $setterName)) {
                $this->{$setterName}($data[$field]);
            }
        }
    }
}
