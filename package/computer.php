<?php

class computer
{
    private $HP;
    
    private $MP;
    
    private $skill;
    
    private $form;
    
    public function getHP()
    {
        return $this->HP;
    }

    public function getMP()
    {
        return $this->MP;
    }

    public function getSkill()
    {
        return $this->skill;
    }

    public function setHP($HP)
    {
        $this->HP = $HP;
    }

    public function setMP($MP)
    {
        $this->MP = $MP;
    }

    public function setSkill($skill)
    {
        $this->skill = $skill;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }
}
