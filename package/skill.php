<?php
class skill
{
    
    //消耗
    private $cost;
    
    //伤害(暂时只有伤害)
    private $damage;
    
    //回复量
    private $gain;
    
    //回复类型
    private $gainType;
    
    //技能名称;
    private $name;
    
    //技能缩写;
    private $shortCut;
    
    public function getCost()
    {
        return $this->cost;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function getGain()
    {
        return $this->gain;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function setDamage($damage)
    {
        $this->damage = $damage;
    }

    public function setGain($gain)
    {
        $this->gain = $gain;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getGainType()
    {
        return $this->gainType;
    }

    public function setGainType($gainType)
    {
        $this->gainType = $gainType;
    }
    
    public function getShortCut()
    {
        return $this->shortCut;
    }

    public function setShortCut($shortCut)
    {
        $this->shortCut = $shortCut;
    }
}
