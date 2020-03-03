<?php

namespace App\Serializable;

use App\Models\AccountInfo;
use Symfony\Component\Serializer\Annotation\Groups;

class AccountInfoSerializer
{
    protected $account_info;

    /**
     * AccountInfoSerializer constructor.
     *
     * @param AccountInfo $account_info
     */
    public function __construct(AccountInfo $account_info)
    {
        $this->account_info = $account_info;
    }

    /**
     * @Groups({"account-info"})
     * @return int
     */
    public function getAccountId()
    {
        return $this->account_info->id;
    }

    /**
     * @Groups({"account-info"})
     * @return string
     */
    public function getAccount()
    {
        return $this->account_info->account;
    }

    /**
     * @Groups({"account-info"})
     * @return string
     */
    public function getName()
    {
        return $this->account_info->name;
    }

    /**
     * @Groups({"account-info"})
     * @return string
     */
    public function getGender()
    {
        return $this->account_info->gender ? '男' : '女';
    }

    /**
     * @Groups({"account-info"})
     * @return string
     */
    public function getBirth()
    {
        return date('Y年m月d日', strtotime($this->account_info->birth));
    }

    /**
     * @Groups({"account-info"})
     * @return string
     */
    public function getEmail()
    {
        return $this->account_info->email;
    }

    /**
     * @Groups({"account-info"})
     * @return string
     */
    public function getMessage()
    {
        return $this->account_info->message;
    }
}