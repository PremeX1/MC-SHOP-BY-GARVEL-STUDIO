<?php
class trueWallet
{
    public function __construct($phone, $voucher)
    {
        $this->mobile = $phone;
        $this->voucher = explode("?v=", $voucher)[1];
    }
    public function toPup()
    {   
        $url = "https://gift.truemoney.com/campaign/vouchers/$this->voucher/redeem";
        $headers = array("CONTENT-TYPE: application/json", "USER-AGENT: X");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSLVERSION, 7);
        $data = json_encode(array(
            'mobile' => $this->mobile,
            'voucher_hash' => $this->voucher
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $resp = curl_exec($ch);
        curl_close($ch);

        return $resp;
    }
}

?>

