<?php
// src/AppBundle/Entity/Blog.php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Blog entity
 * 
 * @ORM\Entity
 * @ORM\Table(name="blog")
 * @ORM\HasLifecycleCallbacks
 * @GRID\Source(columns="id, name, email, created")
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $text
 * @property \DateTime $created
 * @property \DateTime $modified
 */
class Blog
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     * @var string
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Email()
     * @var string
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string
     */
    private $address;
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string
     */
    private $text;  
    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    public $created;
    
    /**
     * @ORM\Column(type="date" , nullable=true)
     * @var \DateTime
     */
    public $modified = null;
    
    /**
     * Get id
     * 
     * 
     * @access public
     * @return int id
     */
    public function getId() {
        return $this->id;
    }  
    
    /**
     * Get Name
     * 
     * @access public
     * @return string name
     */
    public function getName() {
        return $this->name;
    }    
    /**
     * Set Name
     * 
     * @access public
     * @param string $name
     * @return Blog current entity
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Email
     * 
     * @access public
     * @return string email
     */
    public function getEmail() {
        return $this->email;
    }    
    /**
     * Set Email
     * 
     * @access public
     * @param string $email
     * @return Blog current entity
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
  
    /**
     * Get Address
     * 
     * @access public
     * @return string address
     */
    public function getAddress() {
        return $this->address;
    }    
    /**
     * Set Address
     * 
     * @access public
     * @param string $address
     * @return Blog current entity
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }
  
    /**
     * Get Text
     * 
     * @access public
     * @return string text
     */
    public function getText() {
        return $this->text;
    }    
    /**
     * Set Text
     * 
     * @access public
     * @param string $text
     * @return Blog current entity
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    
    /**
     * Get created
     * 
     * 
     * @access public
     * @return \DateTime created
     */
    public function getCreated() {
        return $this->created;
    }
    
    /**
     * Set created
     * 
     * @ORM\PrePersist
     * @access public
     * @return Blog current entity
     */
    public function setCreated() {
        $this->created = new \DateTime();
        return $this;
    }
    
    /**
     * Get modified
     * 
     * 
     * @access public
     * @return \DateTime modified
     */
    public function getModified() {
        return $this->modified;
    }
    
    /**
     * Set modified
     * 
     * @ORM\PreUpdate
     * @access public
     * @return Blog current entity
     */
    public function setModified() {
        $this->modified = new \DateTime();
        return $this;
    }
}
