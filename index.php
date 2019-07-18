<?php
    exec("CHCP 65001");
    require_once 'package/skill.php';
    require_once 'package/player.php';
    require_once 'package/computer.php';
    require_once 'package/QTE.php';
    
    echo "loading.....\n";
    echo "停机信号插拴抽出完毕.....\n";
    echo "神经结合系统完成.....\n";
    echo "开始第一次接触.....\n";
    echo "主电源接续动力传达至所有回路.....\n";
    echo "进入第二次接触.....\n";
    echo "A10神经接续无异常.....\n";
    echo "思考形态改为中文.....\n";
    echo "双向回路开启.....\n";
    echo "第一固定器解除.....\n";
    echo "第二固定器解除.....\n";
    echo "从1号到15号安全装置解除.....\n";
    echo "内部电源充电完毕.....\n";
    echo "WELCOME TO THE VERSUS GAME\n";
    echo "GAME START\n";
    $MAX_HP = 3;
    $MIN_HP = 1;

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
    
    
    $skillList = [
        $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, $skill7, $skill8
    ];
    $attackSkillList = [
        $skill1, $skill2, $skill3, $skill4, $skill8
    ];
    $returningSkillList = [
        $skill5, $skill6
    ];
    $guardSkillList = [
        $skill7
    ];
    
    
    //创建玩家
    $player = new player();
    //设置玩家姓名
    $player->setName('player');
    //初始5格血量
    $player->setHP($MAX_HP);
    //初始0格能量
    $player->setMP(0);
    //设置初始技能
    $player->setSkill($skillList);
    
    //创建对手
    $computer = new computer();
    //设置电脑姓名
    $computer->setName('电脑');
    //初始5格血量
    $computer->setHP($MAX_HP);
    //初始0格能量
    $computer->setMP(0);
    //设置初始技能
    $computer->setSkill($attackSkillList);

    //计算回合数
    $roundTime = 1;

    //创建QTE对象
    $qteObject = new QTE();
    $qteObject->setQteTime(10);//十秒
    $qteObject->setQteLen(8);//长度
    $qteObject->makeQteString();//生成QTE字符串


    //模拟战斗开始
    while (true) {
        echo "第{$roundTime}轮开始: \n";
        echo "请输入本轮的技能指令 \n";
        $AIskill = AI($computer, $MAX_HP, $MIN_HP, $returningSkillList, $guardSkillList);
        //玩家的操作
        $handle = fopen("php://stdin", "r");
        $action = fgets($handle);
        $playSkill = player($action, $player, $faultSkill);
        battle($player, $playSkill, $computer, $AIskill);

        echo "{$player->getName()} 使用 {$playSkill->getName()}, 造成 {$playSkill->getDamage()}点伤害 \n";
        echo "{$computer->getName()} 使用 {$AIskill->getName()}, 造成 {$AIskill->getDamage()}点伤害 \n";
        echo "{$player->getName()},目前血量:{$player->getHP()}, 目前MP:{$player->getMP()}点 \n";
        echo "{$computer->getName()},目前血量:{$computer->getHP()}, 目前MP:{$computer->getMP()}点 \n";
        if ($player->getHP() <= 0) {
            echo "{$player->getName()} 倒下了\n";
            exit;
        }
        if ($computer->getHP() <= 0) {
            //进入QTE模式
            
            echo "请输入以下指令完成处决 {$qteObject->getQteHint()}\n";
            $qteHandle = fopen("php://stdin", "r");
            $qteAction = strtolower(trim(fgets($qteHandle)));
            $qteResult = $qteObject->checkQteString($qteObject->getQteAsc2(), $qteAction);
            if ($qteResult) {
                echo "QTE成功{$computer->getName()}, 倒下了 \n";
                exit;
            } else {
                echo "QTE失败{$computer->getName()}复活,并回复3点血量 \n";
                $computer->setHP(3);
            }
        }
        $roundTime ++;
    }

    //计算玩家的每轮行动
    function player($action, $player, $faultSkill)
    {
        $currentRoundSkill = null;
        foreach ($player->getSkill() as $skill) {
            if (strtoupper(trim($action)) == $skill->getShortCut()) {
                $currentRoundSkill = $skill;
                break;
            }
        }
        return  is_null($currentRoundSkill) ? $faultSkill : $currentRoundSkill;
    }
    
    //计算电脑每轮的行动
    function AI($computer, $MAX_HP, $MIN_HP, $returningSkillList, $guardSkillList)
    {
        $mp = $computer->getMP();
        $hp = $computer->getHP();
        //一开始电脑只会有攻击技能
        $skillList = $computer->getSkill();
        //设置变量用于存储目前能量值所能使用的技能
        $useSkillList = [];
        //遍历电脑掌握的所有技能
        foreach ($skillList as $skill) {
            //找出使用费用低于当前能量的技能放入可用技能列表中
            if ($skill->getCost() <= $mp) {
                array_push($useSkillList, $skill);
            }
        }
        //如果发生扣血的情况下，电脑技能自动追加补血和格挡技能
        if ($hp < $MAX_HP && $hp > $MIN_HP) {
            $neoSkillList = array_merge($returningSkillList, $guardSkillList);
            foreach ($neoSkillList as $skill) {
                if ($skill->getCost() <= $mp) {
                    array_push($useSkillList, $skill);
                }
            }
        } else {//如果血量已经到达最低生命值时,则放弃进行防御（防御自扣1血）
            foreach ($returningSkillList as $skill) {
                if ($skill->getCost() <= $mp) {
                    array_push($useSkillList, $skill);
                }
            }
        }
        //设定随机数，最大只能和可以使用的技能列表长度一样
        $maxRandom = count($useSkillList) - 1;
        $skillIndex = rand(0, $maxRandom);
        //随机取值后从方法返回
        return $useSkillList[$skillIndex];
    }
    
    function battle($player, $playSkill, $computer, $cpuSkill)
    {
        //各自结算技能对自己的收益
        $player = skillSelfEffected($player, $playSkill);
        $computer = skillSelfEffected($computer, $cpuSkill);
        //各自结算释放技能对对方的伤害
        $player = skillEachEffected($player, $playSkill, $cpuSkill);
        $computer = skillEachEffected($computer, $cpuSkill, $playSkill);
    }

    //计算技能对自己产生的影响
    function skillSelfEffected($target, $skill)
    {
        $originHp = $target->getHP();
        $originMp = $target->getMP();
        $effectedType = $skill->getGainType();
        $gain = $skill->getGain();
        //表示本次受影响的字段为hp
        if ($effectedType == 'HP') {
            $effectedVal = $originHp + $gain;
           
            $target->setHP($effectedVal);
        } elseif ($effectedType == 'MP') {
            //本次受影响的为MP字段
            $effectedVal = $originMp + $gain;
            $target->setMP($effectedVal);
        }
        //最终在抵消掉技能释放所消耗的MP
        $currentMp = $target->getMP();
        $cost = $skill->getCost();
        $target->setMP($currentMp - $cost);
        return $target;
    }

    //计算技能对双方产生的影响
    function skillEachEffected($currentUser, $userSkill, $anotherSkill)
    {
        $playerHp = $currentUser->getHP();
        
        //己方技能的伤害
        $userDamage = $userSkill->getDamage();
        //对方技能的伤害
        $anotherDamage = $anotherSkill->getDamage();
        
        //如果对方释放技能和己方释放技能均为攻击性技能，则进入拼招模式
        if($userSkill->getType() == skill::ATTACK_TYPE && $anotherSkill->getType() == skill::ATTACK_TYPE){
            //计算招式互相对拼后的伤害
            $absDamage = abs($userDamage - $anotherDamage);
            //己方招式并没有拼过对方招式
            if($userDamage < $anotherDamage){
                $currentHp = $playerHp - $absDamage;
                $currentUser->setHP($currentHp);
            }
        }else if($userSkill->getType() == skill::MISSING_TYPE){
            //以下为闪避逻辑
            //己方使用闪避则可以不扣血
            $currentUser->setHP($playerHp);
        }else if($userSkill->getType() == skill::MIRROR_TYPE){
            //以下为反射逻辑
            //己方使用反射能力则可以不扣血量
            $currentUser->setHP($playerHp);
        }else if($anotherSkill->getType() == skill::MIRROR_TYPE){
            //对方释放反射能力
            $currentHp = $playerHp - $userDamage;
            $currentUser->setHP($currentHp);
        }else{
            $currentHp = $playerHp - $anotherDamage;
            $currentUser->setHP($currentHp);
        }

        return $currentUser;
    }
