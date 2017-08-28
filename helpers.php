<?php

if (!function_exists('credit')) {
    /**
     * 修改用户经验值
     * @param int $user_id 用户id
     * @param string $action 执行动作：提问、回答、发起文章
     * @param int $modelId 源：问题id、回答id、文章id等
     * @param string $modelSubject 源主题：问题标题、文章标题等
     * @param int $credits 经验值
     * @return bool  操作成功返回true 否则  false
     */
    function credit($userId, $action, $credits = 0, $modelId = 0, $modelSubject = null)
    {
        $extend = \yuncms\user\models\Extend::findOne($userId);
        if ($extend) {
            $transaction = \yuncms\user\models\Extend::getDb()->beginTransaction();
            try {
                /*修改用户账户信息*/
                $extend->updateCounters(['credits' => $credits]);
                \yuncms\credit\models\Credit::create([
                    'user_id' => $userId,
                    'action' => $action,
                    'model_id' => $modelId,
                    'model_subject' => $modelSubject,
                    'credits' => $credits,
                ]);
                $transaction->commit();
                return true;
            } catch (\Exception $e) {
                $transaction->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }
}
 