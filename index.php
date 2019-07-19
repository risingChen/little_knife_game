<?php
    exec("CHCP 65001");
    require_once './package/skill.php';
    require_once './package/player.php';
    require_once './package/computer.php';
    require_once './package/QTE.php';
    require_once './package/form.php';
    require_once './makeSkill.php';

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

    $playSkillList = [
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
    
    $riderKick = new skill();
    $riderKick->setCost(10);
    $riderKick->setDamage(20);
    $riderKick->setGain(0);
    $riderKick->setGainType('MP');
    $riderKick->setName('rider kick');
    $riderKick->setShortCut('RK');
    $riderKick->setType(skill::ATTACK_TYPE);

    $form1 = new form();
    //形态名称
    $form1->setFormName('变身');
    //设置转换形态所需要消耗的能量值
    $form1->setFormCostMp(3);
    //设置形态的基础血量
    $form1->setFormHP(5);
    //设置形态的基础能量值
    $form1->setFormMP(2);
    //待定
    $form1->setPassive();
    //设置形态的超必杀
    $form1->setOT($riderKick);
    //设置形态快捷键
    $from1->setShortCut('HS');
    
    //创建玩家
    $player = new player();
    //设置玩家姓名
    $player->setName('player');
    //初始5格血量
    $player->setHP($MAX_HP);
    //初始0格能量
    $player->setMP(0);
    //设置初始技能
    $player->setSkill($playSkillList);
    //为玩家设定变身形态
    $player->setForm($form1);
    
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
    $qteObject->setQteTime(3);//十秒
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
        $player = HenShin($action, $player);
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

    //计算角色的形态转换
    function HenShin($action, $currentUser)
    {
        $command = strtoupper(trim($action));
        //玩家确认使用状态变化
        if($command == $currentUser->getForm()->getShortCut()){
            //所属能量满足形态变化所需的能量
            if($currentUser->getMP() >= $currentUser->getForm()->getFormCostMp()){
                //将转换形态后的数值覆盖至原来数值
                $currentUser->setHP($currentUser->getForm()->getFormHP());
                $currentUser->setMP($currentUser->getForm()->getFormMP());
                echo "{$currentUser->getName()} 使用 {$currentUser->getForm()->getFormName()} \n";
            }    
        }
        return $currentUser;
    }

    //计算玩家的每轮所使用的技能
    function player($action, $player, $faultSkill)
    {
        $command = strtoupper(trim($action));
        $currentRoundSkill = null;
        foreach ($player->getSkill() as $skill) {
            if ($command == $skill->getShortCut()) {
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
