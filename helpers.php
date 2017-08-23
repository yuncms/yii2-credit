<?php

if (!function_exists('credit')) {
    /**
     * 修改用户经验值
     * @param int $user_id 用户id
     * @param string $action 执行动作：提问、回答、发起文章
     * @param int $sourceId 源：问题id、回答id、文章id等
     * @param string $sourceSubject 源主题：问题标题、文章标题等
     * @param int $credits 经验值
     * @return bool  操作成功返回true 否则  false
     */
    function credit($user_id, $action, $credits = 0, $sourceId = 0, $sourceSubject = null)
    {
        $extend = \yuncms\user\models\Extend::findOne($user_id);
        if ($extend) {
            $transaction = \yuncms\user\models\Extend::getDb()->beginTransaction();
            try {
                /*修改用户账户信息*/
                $extend->updateCounters(['credits' => $credits]);
                \yuncms\credit\models\Credit::create([
                    'user_id' => $user_id,
                    'action' => $action,
                    'source_id' => $sourceId,
                    'source_subject' => $sourceSubject,
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
 