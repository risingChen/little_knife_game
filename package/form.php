<?php
class form{
    
    //形态名称
    private $formName;
    //变形态所需的MP;
    private $formCostMp;
    //形态血量
    private $formHP;
    //形态初始mp
    private $formMP;
    //形态被动
    private $passive;
    //形态专属大技能
    private $OT;

    /**
     * Get the value of formName
     */ 
    public function getFormName()
    {
        return $this->formName;
    }

    /**
     * Set the value of formName
     *
     * @return  self
     */ 
    public function setFormName($formName)
    {
        $this->formName = $formName;

        return $this;
    }

    /**
     * Get the value of formCostMp
     */ 
    public function getFormCostMp()
    {
        return $this->formCostMp;
    }

    /**
     * Set the value of formCostMp
     *
     * @return  self
     */ 
    public function setFormCostMp($formCostMp)
    {
        $this->formCostMp = $formCostMp;

        return $this;
    }

    /**
     * Get the value of formHP
     */ 
    public function getFormHP()
    {
        return $this->formHP;
    }

    /**
     * Set the value of formHP
     *
     * @return  self
     */ 
    public function setFormHP($formHP)
    {
        $this->formHP = $formHP;

        return $this;
    }

    /**
     * Get the value of formMP
     */ 
    public function getFormMP()
    {
        return $this->formMP;
    }

    /**
     * Set the value of formMP
     *
     * @return  self
     */ 
    public function setFormMP($formMP)
    {
        $this->formMP = $formMP;

        return $this;
    }

    /**
     * Get the value of passive
     */ 
    public function getPassive()
    {
        return $this->passive;
    }

    /**
     * Set the value of passive
     *
     * @return  self
     */ 
    public function setPassive($passive)
    {
        $this->passive = $passive;

        return $this;
    }

    /**
     * Get the value of OT
     */ 
    public function getOT()
    {
        return $this->OT;
    }

    /**
     * Set the value of OT
     *
     * @return  self
     */ 
    public function setOT($OT)
    {
        $this->OT = $OT;

        return $this;
    }
}