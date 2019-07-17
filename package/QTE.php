<?php
class QTE
{
    protected $QTETemplate = [
        ['key' => 'w' , 'value' => '119'],
        ['key' => 'a' , 'value' => '97'],
        ['key' => 's' , 'value' => '115'],
        ['key' => 'd' , 'value' => '100'],
    ];

    private $qteString;

    private $qteAsc2;

    private $qteHint;

    private $qteLen;
    
    private $qteTime;

    /**
     * Get the value of qteString
     */
    public function getQteString()
    {
        return $this->qteString;
    }

    /**
     * Set the value of qteString
     *
     * @return  self
     */
    public function setQteString($qteString)
    {
        $this->qteString = $qteString;

        return $this;
    }

    /**
     * Get the value of qteAsc2
     */
    public function getQteAsc2()
    {
        return $this->qteAsc2;
    }

    /**
     * Set the value of qteAsc2
     *
     * @return  self
     */
    public function setQteAsc2($qteAsc2)
    {
        $this->qteAsc2 = $qteAsc2;

        return $this;
    }

    /**
     * Get the value of qteHint
     */
    public function getQteHint()
    {
        return $this->qteHint;
    }

    /**
     * Set the value of qteHint
     *
     * @return  self
     */
    public function setQteHint($qteHint)
    {
        $this->qteHint = $qteHint;

        return $this;
    }


    /**
     * Get the value of qteLen
     */
    public function getQteLen()
    {
        return $this->qteLen;
    }

    /**
     * Set the value of qteLen
     *
     * @return  self
     */
    public function setQteLen($qteLen)
    {
        $this->qteLen = $qteLen;

        return $this;
    }

    /**
     * Get the value of qteTime
     */
    public function getQteTime()
    {
        return $this->qteTime;
    }

    /**
     * Set the value of qteTime
     *
     * @return  self
     */
    public function setQteTime($qteTime)
    {
        $this->qteTime = $qteTime;

        return $this;
    }

    //生成qte用字符串
    public function makeQteString()
    {
        $qteString = '';
        $qteHint = '';
        $qteAsc2 = '';
        for ($i = 0; $i < $this->getQteLen(); $i++) {
            $index = rand(0, count($this->QTETemplate) - 1);
            $qteString .= $this->QTETemplate[$index]['key'];
            $qteHint .= $this->QTETemplate[$index]['key'] . ' ';
            $qteAsc2 .= $this->QTETemplate[$index]['value'];
        }

        $this->setQteString($qteString);
        $this->setQteHint($qteHint);
        $this->setQteAsc2($qteAsc2);
    }

    //效验输入的字符串是否与qte字串相吻合
    public function checkQteString($qteAsc2, $inputQte)
    {
        $inputAsc = '';
        for ($i = 0; $i< strlen($inputQte); $i++) {
            $inputAsc .= ord($inputQte[$i]);
        }
        if ($qteAsc2 == $inputAsc) {
            return true;
        } else {
            return false;
        }
    }
}
