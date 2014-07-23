<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

vimport('~~/vtlib/Vtiger/Net/Client.php');
vimport('~~/vtlib/Vtiger/Package.php');

class Settings_ModuleManager_Extension_Model extends Vtiger_Base_Model {

	STATIC $EXTENSION_LOOKUP_URL = 'https://marketplace.vtiger.com/api';

	var $fileName;

	public static function getUploadDirectory($isChild = false) {
		$uploadDir .= 'test/vtlib';
		if ($isChild) {
			$uploadDir = '../'.$uploadDir;
		}
		return $uploadDir;
	}

	public static function getExtensionsLookUpUrl() {
		$extensionLookUpUrl = vglobal('EXTENSION_LOOKUP_URL');
		if (!self::$EXTENSION_LOOKUP_URL && $extensionLookUpUrl) {
			self::$EXTENSION_LOOKUP_URL = $extensionLookUpUrl;
		}
		return self::$EXTENSION_LOOKUP_URL;
	}

	/**
	 * Function to set id for this instance
	 * @param <Integer> $extensionId
	 * @return <type>
	 */
	public function setId($extensionId) {
		$this->set('id', $extensionId);
		return $this;
	}

	/**
	 * Function to set file name for this instance
	 * @param <type> $fileName
	 * @return <type>
	 */
	public function setFileName($fileName) {
		$this->fileName = $fileName;
		return $this;
	}

	/**
	 * Function to get Id of this instance
	 * @return <Integer> id
	 */
	public function getId() {
		return $this->get('id');
	}

	/**
	 * Function to get name of this instance
	 * @return <String> module name
	 */
	public function getName() {
		return $this->get('name');
	}

	/**
	 * Function to get file name of this instance
	 * @return <String> file name
	 */
	public function getFileName() {
		return $this->fileName;
	}

	/**
	 * Function to get package of this instance
	 * @return <Vtiger_Package> package object
	 */
	public function getPackage() {
		$packageModel = new Vtiger_Package();
		$moduleName = $packageModel->getModuleNameFromZip(self::getUploadDirectory(). '/' .$this->getFileName());
		if ($moduleName) {
			return $packageModel;
		}
		return false;
	}

	/**
	 * Function to check whether it is compatible with vtiger or not
	 * @return <boolean> true/false
	 */
	public function isVtigerCompatible() {
		vimport('~~/vtlib/Vtiger/Version.php');
		$vtigerVersion = $this->get('vtigerVersion');
		$vtigerMaxVersion = $this->get('vtigerMaxVersion');

		if ((Vtiger_Version::check($vtigerVersion, '>=') && $vtigerMaxVersion && Vtiger_Version::check($vtigerMaxVersion, '<'))
				|| Vtiger_Version::check($vtigerVersion, '=')) {
			return true;
		}
		return false;
	}

	/**
	 * Function to check whether the module is already exists or not
	 * @return <true/false>
	 */
	public function isAlreadyExists() {
		$moduleName = $this->getName();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		if($moduleModel) {
			return true;
		}
		return false;
	}

	/**
	 * Function to check whether the module is upgradable or not
	 * @return <type>
	 */
	public function isUpgradable() {
		$moduleName = $this->getName();
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		if ($moduleModel) {
			if ($moduleModel->get('version') < $this->get('pkgVersion')) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Function to get instance by using XML node
	 * @param <XML DOM> $extensionXMLNode
	 * @return <Settings_ModuleManager_Extension_Model> $extensionModel
	 */
	public static function getInstanceFromXMLNodeObject($extensionXMLNode) {
		$extensionModel = new self();
		$objectProperties = get_object_vars($extensionXMLNode);

		foreach($objectProperties as $propertyName => $propertyValue) {
			$propertyValue = (string)$propertyValue;
			if ($propertyName === 'description') {
				$propertyValue = nl2br(str_replace(array('<','>'), array('&lt;', '&gt;'), br2nl(trim($propertyValue))));
			}
			$extensionModel->set($propertyName, $propertyValue);
		}

		$label = $extensionModel->get('label');
		if (!$label) {
			$extensionModel->set('label', $extensionModel->getName());
		}
		return $extensionModel;
	}

	/**
	 * Function to get instance by using id
	 * @param <Integer> $extensionId
	 * @param <String> $fileName
	 * @return <Settings_ModuleManager_Extension_Model> $extension Model
	 */
	public static function getInstanceById($extensionId, $fileName = false) {
		$uploadDir = self::getUploadDirectory();
		if ($fileName) {
			if (is_dir($uploadDir)) {
				$uploadFileName = "$uploadDir/$fileName";
				checkFileAccess(self::getUploadDirectory());

				$extensionModel = new self();
				$extensionModel->setId($extensionId)->setFileName($fileName);
				return $extensionModel;
			}
		} else {
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir);
			}
			$uploadFile = 'usermodule_'. time() . '.zip';
			$uploadFileName = "$uploadDir/$uploadFile";
			checkFileAccess(self::getUploadDirectory());

			$packageAvailable = Settings_ModuleManager_Extension_Model::download($extensionId, $uploadFileName);
			if ($packageAvailable) {
				$extensionModel = new self();
				$extensionModel->setId($extensionId)->setFileName($uploadFile);
				return $extensionModel;
			}
		}
		return false;
	}
        
        /**
	 * Function to get instance by using XML node
	 * @param <XML DOM> $extensionXMLNode
	 * @return <Settings_ExtensionStore_Extension_Model> $extensionModel
	 */
	public static function getInstanceFromArray($listing) {
		$extensionModel = new self();
		
		foreach ($listing as $key => $value) {
			switch ($key) {
                        case 'name'    :   $key = 'label'; break;
                        case 'identifier': $key = 'name'; break;
			case 'version' :   $key = 'pkgVersion'; break;
			case 'minrange':   $key = 'vtigerVersion'; break;
			case 'maxrange':   $key = 'vtigerMaxVersion'; break;
			case 'CustomerId': $key = 'publisher'; break;
			case 'price':      $value = $value ? $value : 'Free'; break;
			case 'approvedon': $key = 'pubDate'; break;
			case 'ListingFileId': 
				if ($value) {
					$key = 'downloadURL'; 
					$value = self::$EXTENSION_LOOKUP_URL . '/customer/listingfiles?id='.$value;
				}
				break;
                        case 'thumbnail': 
                               if ($value) {
                                   $key = 'thumbnailURL';
                                   $value = str_replace('api', "_listingimages/$value", self::$EXTENSION_LOOKUP_URL);
                               }
                               break;
                        }
			$extensionModel->set($key, $value);
		}

		$label = $extensionModel->get('label');
		if (!$label) {
                    $extensionModel->set('label', $extensionModel->getName());
		}
		return $extensionModel;
	}

	/**
	 * Function to get all availible extensions
	 * @param <Object> $xmlContent
	 * @return <Array> list of extensions <Settings_ModuleManager_Extension_Model>
	 */
	public static function getAll($id=null) {
            $extensionModelsList = array();
            $q = $id ? array('id' => $id) : null;
            $q ? array('q' => Zend_Json::encode($q)) : null;
            $extensionLookUpUrl = self::getExtensionsLookUpUrl().'/app/listings';
            if ($extensionLookUpUrl) {
                    $clientModel = new Vtiger_Net_Client($extensionLookUpUrl);
                    $content = $clientModel->doGet($q);
                    $json = Zend_Json::decode($content);
                    if ($json) {
                            if ($json['success']) {
                                    $result = $json['result'];
                            } else {
                                    // TODO: Propogate back failure
                            }
                    }
                    if ($result) {
                            if (!is_array($result)) $result = array($result);
                            foreach ($result as $listing) {
                                    $extensionModelsList[(string)$listing['id']] = self::getInstanceFromArray($listing);
                            }
                    }
            }
            return $extensionModelsList;
    }

	/**
	 * Function to download the file of this instance
	 * @param <Integer> $extensionId
	 * @param <String> $targetFileName
	 * @return <boolean> true/false
	 */
	public static function download($extensionId, $targetFileName) {
		$extensions = self::getAll();
		$downloadURL = $extensions[$extensionId]->get('downloadURL');

		if ($downloadURL) {
			$clientModel = new Vtiger_Net_Client($downloadURL);
			file_put_contents($targetFileName, $clientModel->doGet());
			return true;
		}
		return false;
	}
        
        /**
	 * Function to get extensions based on search
	 * @param <String> search term
	 * @return <Array> list of extensions <Settings_ExtensionStore_Extension_Model>
	 */
	public static function getSearchedExtensions($searchTerm=null) {
            $extensionModelsList = array();
            $searchExtensionUrl = self::getExtensionsLookUpUrl().'/app/searchlistings';
            $param = array('term' => $searchTerm);

            if ($searchExtensionUrl) {
                    $clientModel = new Vtiger_Net_Client($searchExtensionUrl);
                    $content = $clientModel->doGet(array('q' => Zend_Json::encode($param)));
                    $json = Zend_Json::decode($content);
                    if ($json) {
                            if ($json['success']) {
                                    $result = $json['result'];
                            } else {
                                    // TODO: Propogate back failure
                            }
                    }
                    if ($result) {
                            if (!is_array($result)) $result = array($result);
                            foreach ($result as $listing) {
                                    $extensionModelsList[(string)$listing['id']] = self::getInstanceFromArray($listing);
                            }
                    }
            }
            return $extensionModelsList;
	}
}
