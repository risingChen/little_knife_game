<?php
        //技能0 发呆
        $faultSkill = new skill();
        $faultSkill->setCost(0);
        $faultSkill->setDamage(0);
        $faultSkill->setGain(0);
        $faultSkill->setGainType('HP');
        $faultSkill->setName('发呆');
        $faultSkill->setShortCut('FAULT');
        $faultSkill->setType(skill::FAULT_TYPE);
    
        //技能1 集能
        $skill1 = new skill();
        $skill1->setCost(0);
        $skill1->setDamage(0);
        $skill1->setGain(1);
        $skill1->setGainType('MP');
        $skill1->setName('充能');
        $skill1->setShortCut('C');
        $skill1->setType(skill::CHARGE_TYPE);
        
        //技能2 手里剑 伤害1 所需能量1
        $skill2 = new skill();
        $skill2->setCost(1);
        $skill2->setDamage(1);
        $skill2->setGain(0);
        $skill2->setGainType('HP');
        $skill2->setName('手里剑');
        $skill2->setShortCut('K');
        $skill2->setType(skill::ATTACK_TYPE);
        
        //技能3 风魔手里剑 伤害2 所需能量2
        $skill3 = new skill();
        $skill3->setCost(2);
        $skill3->setDamage(2);
        $skill3->setGain(0);
        $skill3->setGainType('HP');
        $skill3->setName('风魔手里剑');
        $skill3->setShortCut('F');
        $skill3->setType(skill::ATTACK_TYPE);
        
        
        //技能4 风雷震落 伤害3 所需能量3
        $skill4 = new skill();
        $skill4->setCost(3);
        $skill4->setDamage(3);
        $skill4->setGain(0);
        $skill4->setGainType('HP');
        $skill4->setName('风雷震落');
        $skill4->setShortCut('R');
        $skill4->setType(skill::ATTACK_TYPE);
        
        //技能5 奶  回复1 所需能量1
        $skill5 = new skill();
        $skill5->setCost(1);
        $skill5->setDamage(0);
        $skill5->setGain(1);
        $skill5->setGainType('HP');
        $skill5->setName('治疗');
        $skill5->setShortCut('M');
        $skill5->setType(skill::RECOVER_TYPE);
        
        //技能6 死者苏生 回复5 所需能量5
        $skill6 = new skill();
        $skill6->setCost(5);
        $skill6->setDamage(0);
        $skill6->setGain(5);
        $skill6->setGainType('HP');
        $skill6->setName('死者苏生');
        $skill6->setShortCut('S');
        $skill6->setType(skill::RECOVER_TYPE);
    
        //技能7 格挡
        $skill7 = new skill();
        $skill7->setCost(3);
        $skill7->setDamage(0);
        $skill7->setGain(0);
        $skill7->setGainType('HP');
        $skill7->setName('神圣防护罩-反射镜力');
        $skill7->setShortCut('G');
        $skill7->setType(skill::MIRROR_TYPE);
    
        //技能7 闪避
        $skill8 = new skill();
        $skill8->setCost(1);
        $skill8->setDamage(0);
        $skill7->setGain(0);
        $skill8->setGainType('HP');
        $skill8->setName('闪避');
        $skill8->setShortCut('D');
        $skill8->setType(skill::MISSING_TYPE);
