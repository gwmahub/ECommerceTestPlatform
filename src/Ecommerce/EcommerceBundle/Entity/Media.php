<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Media
 *
 * @ORM\Table(name="ec_media")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="cl_securedfn", type="string", length=255, nullable=true)
	 */
	private $securedClientFileName;
	// Nom complet sécurisé du fichier d'origine créé sur base de clientfilename + clientfileextension
	// MEMO ajouter les @ORM puis màj de la DB

	/**
	 * @var string
	 *
	 * @ORM\Column(name="wfn", type="string", length=255)
	 */
	private $webfilename; 	// Nom du fichier sécurisé sur le server + son extension
	/**
	 * @var UploadedFile
	 */
    private $file; // Objet File

    private $tempFileName; //dfbvqelibhrothynerpts.jpg
	/**
	 * @var string
	 * @ORM\Column(name="ftdir", type="string", length=255, nullable=false)
	 */
	private $fileTargetDir;




	public function setFileTargetDir($fileTargetDir){

		return $this->fileTargetDir = $fileTargetDir;
	}

	public function getFileTargetDir(){

		return $this->fileTargetDir;
	}


	// Useful for Twig
	public function getWebPath(){

		return $this->getUploadDir().$this->webfilename;
	}


	public function getUploadDir(){

		return 'uploads'.$this->fileTargetDir.'/';
	}

	public function getUploadRootDir(){

		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}


	public function setFile( UploadedFile $file=null ){
		$this->file = $file;

		if( null !== $this->webfilename ){
			$this->tempFileName             = $this->webfilename;
			$this->webfilename              = null;
			$this->securedClientFileName    = null;
		}
	}

	/**
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 *
	 * @return bool
	 */
	public function preUpload(){
		if( null !== $this->file ) {
			$this->securedClientFileName = $this->clientSecuredFileNameGenerator( $this->file->getClientOriginalName(), $this->file->guessExtension() );
			$this->webfilename           = sha1( uniqid( mt_rand(), true ) ) . '.' . $this->file->guessExtension();

			return true;
		}
		// Add the default nopic.png image if no file is downloaded.
		$this->securedClientFileName    = 'NOPIC.PNG';
		$this->fileTargetDir            = '/img';
		$this->webfilename              = 'nopic.png';

		return false;
	}

	public function clientSecuredFileNameGenerator( $clientFileName, $clientfileExtension ){
		$clientfileExtensionLength = strlen($clientfileExtension);
		$pattern = "#[ ,'+\-\#\!\^\$\(\)\[\]\{\}\?\+\*\.\\\| ]+#";
		$clientFileName = substr(preg_replace($pattern, "_", $clientFileName ),0,  (-$clientfileExtensionLength) ).'.';
		$r = array();
		$a = array("ä", "â", "à");
		$e = array("é", "è", "ê", "ë");
		$i = array("ï", "î");
		$o = array("ö", "ô");
		$u = array("ù", "û", "ü");
		$clientFileName = str_replace($a, "a", $clientFileName);
		$clientFileName = str_replace($e, "e", $clientFileName);
		$clientFileName = str_replace($i, "i", $clientFileName);
		$clientFileName = str_replace($o, "o", $clientFileName);
		$clientFileName = str_replace($u, "u", $clientFileName);
		$clientFileName = mb_strtoupper($clientFileName).$clientfileExtension;

		return $clientFileName;
	}

	/**
	 * @ORM\PostPersist()
	 * @ORM\PostUpdate()
	 */
	public function upload(){
		if( null == $this->file ) { return; }

		if( null !== $this->tempFileName ){
			$oldFile = $this->getUploadRootDir().'/'.$this->tempFileName;
			if ( file_exists( $oldFile ) ) {
				unlink( $oldFile );
			}
		}
		$this->file->move( $this->getUploadRootDir(), $this->webfilename );
		unset( $this->file );
	}

	/**
	 * @ORM\PreRemove()
	 */
	public function preRemoveUpload(){
		if( $this->webfilename !== 'nopic.png' ){
			$this->tempFileName = $this->getUploadRootDir().'/'.$this->webfilename;
		}
//		$this->tempFileName = false;
		$this->webfilename = false;
	}
	/**
	 * @ORM\PostRemove()
	 */
	public function postRemoveUpload(){
		if( file_exists($this->tempFileName) ){
			unlink( $this->tempFileName );
		}
	}

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set webfilename
     *
     * @param string $webfilename
     *
     * @return string
     */
    public function setWebfilename( $webfilename )
    {
        $this->webfilename = $webfilename;

        return $this;
    }

    /**
     * Get webfilename
     *
     * @return string
     */
    public function getWebfilename()
    {
        return $this->webfilename;
    }


    public function getFile(){

    	return $this->file;
    }

    /**
     * Set securedClientFileName
     *
     * @param string $securedClientFileName
     *
     * @return Media
     */
    public function setsecuredClientFileName($securedClientFileName)
    {
        $this->securedClientFileName = $securedClientFileName;

        return $this;
    }

    /**
     * Get securedClientFileName
     *
     * @return string
     */
    public function getsecuredClientFileName()
    {
        return $this->securedClientFileName;
    }
}
