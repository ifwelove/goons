<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed          id
 * @property int            f_id                  fd.client.ID
 * @property int            s_id                  sd.client.ID
 * @property null|string    code                  公司代碼
 * @property null|string    company_tax_id_number 公司統一編號
 * @property null|string    company_name          公司名稱
 * @property null|string    company_addr          公司地址
 * @property null|string    person_phone          負責人(聯絡窗口)電話
 * @property null|string    person_mail           負責人(聯絡窗口)信箱
 * @property string         source                分類
 * @property null|int       industry              產業別
 * @property string         region                客戶國別
 * @property string         status                是否啟停用：0:停用,1:啟用
 * @property string         sms_status            簡訊功能啟用狀態
 * @property \Carbon\Carbon create_datetime       新增時間
 * @property \Carbon\Carbon update_datetime       更新時間
 * @property mixed          deleted_at            軟刪除時間
 * @property null|string    memo                  備註
 * @property string         clk_map_status        是否啟停用(EDM熱點分析)：0:停用,1:啟用
 * @property string         fail_report_status    是否啟停用(取得失敗報表)：0:停用,1:啟用
 * @property string         payment_status        是否啟停用(線上加值功能)：0:停用,1:啟用
 * @property bool           dealline              加值後付款時間：單位(日)
 */
class Client extends Model
{
    protected $table = 'client';

    protected $guarded = [];

    public $timestamps = false;

    protected $primaryKey = 'id';

    const FDSD = 'fdsd';

    protected $appends = [
        'is_fdsd',
    ];

    public function getIsFdsdAttribute()
    {
        return $this->source === self::FDSD;
    }

    public function Users()
    {
        return $this->hasMany(SysAdmin::class);
    }

    public function senders()
    {
        return $this->hasMany(ClientSender::class, 'client_id', 'id');
    }
}
