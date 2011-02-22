<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2010 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// {{{ requires
require_once(CLASS_REALDIR . "pages/admin/LC_Page_Admin.php");

/**
 * システム管理 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_System_Input extends LC_Page_Admin {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $this->tpl_mainpage = 'system/input.tpl';

        // マスタ-データから権限配列を取得
        $masterData = new SC_DB_MasterData_Ex();
        $this->arrAUTHORITY = $masterData->getMasterData('mtb_authority');

        $this->httpCacheControl('nocache');
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        // ログインチェック
        SC_Utils::sfIsSuccess(new SC_Session());

        // ページ送りの処理 $_REQUEST['pageno']が信頼しうる値かどうかチェックする。
        $this->tpl_pageno = $this->lfCheckPageNo($_REQUEST['pageno']);

        switch($this->getMode()) {
        case 'new':
            $this->execNewMode();
            break;

        case 'edit':
            $this->execEditMode();
            break;

        default:
            $this->execDefaultMode();
            break;
        }
        $this->setTemplate($this->tpl_mainpage);
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    /**
     * newアクションの実行
     * メンバーデータの新規登録を行う.
     *
     * @param void
     * @return void
     */
    function execNewMode() {

        $this->objForm = $this->initNewMode();

        $arrErr = $this->validateNewMode();

        $this->arrForm = $this->objForm->getHashArray();

        if (count($arrErr) > 0) {
            // 入力された値を保持する
            $this->tpl_mode      = $this->getMode();
            $this->tpl_member_id = '';
            $this->tpl_old_login_id = '';

            // パスワードは保持しない
            $this->arrForm['password'] = '';
            // エラー情報をセットする
            $this->arrErr = $arrErr;
            return;
        }

        $this->insertMemberData($this->arrForm);
        // 親ウィンドウを更新後、自ウィンドウを閉じる。
        $url = ADMIN_SYSTEM_URLPATH . "?pageno=" . $this->arrForm['pageno'];
        $this->tpl_onload = "fnUpdateParent('".$url."'); window.close();";
    }

    /**
     * newアクションの初期化.
     * SC_FormParamのインスタンスをメンバ変数にセットする.
     *
     * @param string $mode editの時は指定
     * @return object SC_FormParamのインスタンス
     */
    function initNewMode($mode = "") {
        $objForm = new SC_FormParam();

        $objForm->addParam('メンバーID', 'member_id', INT_LEN, 'n', array('NUM_CHECK'));
        $objForm->addParam('名前', 'name', STEXT_LEN, 'KV', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objForm->addParam('所属', 'department', STEXT_LEN, 'KV', array('MAX_LENGTH_CHECK'));
        $objForm->addParam('ログインID', 'login_id', '' , '', array('EXIST_CHECK', 'ALNUM_CHECK'));
        $objForm->addParam('変更前ログインID', 'old_login_id', '' , '', array('ALNUM_CHECK'));
        if ($mode == "edit" && $_POST['password'] == DEFAULT_PASSWORD) {
            $objForm->addParam('パスワード', 'password', '' , '', array('EXIST_CHECK'));
        } else {
        	$objForm->addParam('パスワード', 'password', '' , '', array('EXIST_CHECK', 'ALNUM_CHECK'));
        }
        $objForm->addParam('権限', 'authority', INT_LEN, '', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objForm->addParam('稼働/非稼働', 'work', INT_LEN, '', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objForm->addParam('ページ', 'pageno', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));

        $objForm->setParam($_POST);
        $objForm->convParam();

        return $objForm;
    }

    /**
     * newアクションのパラメータ検証を行う.
     *
     * @param void
     * @return array エラー情報の連想配列
     */
    function validateNewMode() {
        $arrErr = $this->objForm->checkError();
        if (isset($arrErr) && count($arrErr) > 0) return $arrErr;

        // ログインID・パスワードの文字数チェック
        $objErr = new SC_CheckError();
        $objErr->doFunc(array("パスワード", 'password', ID_MIN_LEN, ID_MAX_LEN), array("NUM_RANGE_CHECK"));
        $objErr->doFunc(array("ログインID", 'login_id', ID_MIN_LEN, ID_MAX_LEN), array("NUM_RANGE_CHECK"));

        $arrErr = $objErr->arrErr;

        // 管理者名が登録済みでないか
        if ($this->memberDataExists('name = ?', $_POST['name'])) {
            $arrErr['name'] = "既に登録されている名前なので利用できません。<br>";
        }
        // ログインIDが登録済みでないか
        if ($this->memberDataExists('login_id = ?', $_POST['login_id'])) {
            $arrErr['login_id'] = "既に登録されているIDなので利用できません。<br>";
        }

        return $arrErr;
    }

    /**
     * editアクションの実行
     * メンバーデータの更新を行う.
     *
     * @param void
     * @return void
     */
    function execEditMode() {
        if (SC_Helper_Session_Ex::isValidToken() !== true) {
            SC_Utils::sfDispError('');
        }

        $this->objForm = $this->initNewMode("edit");

        $arrErr = $this->validateEditMode();

        $this->arrForm = $this->objForm->getHashArray();

        if (count($arrErr) > 0) {
            // 入力された値を保持する
            $this->tpl_mode      = $this->getMode();
            $this->tpl_member_id = $this->arrForm['member_id'];
            $this->tpl_old_login_id = $this->arrForm['old_login_id'];

            // パスワードは保持しない
            $this->arrForm['password'] = '';
            // エラー情報をセットする
            $this->arrErr = $arrErr;
            return;
        }

        $this->updateMemberData($this->arrForm['member_id'], $this->arrForm);
        // 親ウィンドウを更新後、自ウィンドウを閉じる。
        $url = ADMIN_SYSTEM_URLPATH . "?pageno=" . $this->arrForm['pageno'];
        $this->tpl_onload = "fnUpdateParent('".$url."'); window.close();";
    }

    /**
     * editアクションのパラメータ検証を行う.
     *
     * @param void
     * @return array エラー情報の連想配列
     */
    function validateEditMode() {
        $arrErr = $this->objForm->checkError();
        if (isset($arrErr) && count($arrErr) > 0) return $arrErr;

        // ログインID・パスワードの文字数チェック
        $objErr = new SC_CheckError();
        $objErr->doFunc(array("パスワード", 'password', ID_MIN_LEN, ID_MAX_LEN), array("SPTAB_CHECK" ,"NUM_RANGE_CHECK"));
        $objErr->doFunc(array("ログインID", 'login_id', ID_MIN_LEN, ID_MAX_LEN), array("SPTAB_CHECK" ,"NUM_RANGE_CHECK"));

        $arrErr = $objErr->arrErr;

        // ログインIDが変更されている場合はチェックする。
        if ($_POST['login_id'] != $_POST['old_login_id']) {
            // ログインIDが登録済みでないか
            if ($this->memberDataExists('login_id = ?', $_POST['login_id'])) {
                $arrErr['login_id'] = "既に登録されているIDなので利用できません。<br>";
            }
        }

        return $arrErr;
    }

    /**
     * defaultアクションを実行する.
     * 初回表示時に実行される.
     * $GET['id']が渡された場合、編集モードとして表示,
     * 無い場合は新規登録モードとして表示する.
     *
     * @param void
     * @return void
     */
    function execDefaultMode() {

        // $_GET['id']（member_id）が登録済みのものかチェック。
        // 登録されていない場合は不正なものとして、新規扱いとする。
        $clean_id = "";
        $clean_mode_flg = "new";
        
        // idが0より大きい数字で整数の場合
        if (isset($_GET['id']) && SC_Utils::sfIsInt($_GET['id']) && $_GET['id'] > 0) {
            if ($this->memberDataExists('member_id = ? AND del_flg = 0', $_GET['id'])) {
                $clean_id = $_GET['id'];
                $clean_mode_flg = "edit";
            }
        }

        switch($clean_mode_flg) {
        case 'edit':
            $this->tpl_mode      = $clean_mode_flg;
            $this->tpl_member_id = $clean_id;
            $this->tpl_onfocus   = "fnClearText(this.name);";
            $this->arrForm       = $this->getMemberData($clean_id);
            $this->arrForm['password'] = DEFAULT_PASSWORD;
            $this->tpl_old_login_id    = $this->arrForm['login_id'];
            break;

        case 'new':
        default:
            $this->tpl_mode = $clean_mode_flg;
            $this->arrForm['authority'] = -1;
            break;
        }
    }

    /**
     * DBからmember_idに対応する管理者データを取得する
     *
     * @param integer $id メンバーID
     * @return array 管理者データの連想配列, 無い場合は空の配列を返す
     */
    function getMemberData($id) {
        $table   = 'dtb_member';
        $columns = 'name,department,login_id,authority, work';
        $where   = 'member_id = ?';

        $objQuery =& SC_Query::getSingletonInstance();
        $arrRet = $objQuery->select($columns, $table, $where, array($id));

        if (is_null($arrRet)) return array();

        return $arrRet[0];
    }

    /**
     *  値が登録済みかどうかを調べる
     *
     * @param string $where WHERE句
     * @param string $val 検索したい値
     * @return boolean 登録済みならtrue, 未登録ならfalse
     */
    function memberDataExists($where, $val) {
        $table = 'dtb_member';

        $objQuery =& SC_Query::getSingletonInstance();
        $count = $objQuery->count($table, $where, array($val));

        if ($count > 0) return true;
        return false;
    }

    /**
     * ページ番号が信頼しうる値かチェックする.
     *
     * @access private
     * @param  integer $pageno ページの番号
     * @return integer $clean_pageno チェック後のページの番号
     */
    function lfCheckPageNo($pageno) {

        $clean_pageno = "";

        // $pagenoが0以上の整数かチェック
        if(SC_Utils_Ex::sfIsInt($pageno) && $pageno > 0) {
            $clean_pageno = $pageno;
        }

        // 例外は全て1とする
        else {
            $clean_pageno = 1;
        }

        return $clean_pageno;
    }

    /**
     * 入力された管理者データをInsertする.
     *
     * @param array 管理者データの連想配列
     * @return void
     */
    function insertMemberData($arrMemberData) {
        $objQuery =& SC_Query::getSingletonInstance();

        // INSERTする値を作成する.
        $salt                  = SC_Utils_Ex::sfGetRandomString(10);
        $sqlVal = array();
        $sqlVal['name']        = $arrMemberData['name'];
        $sqlVal['department']  = $arrMemberData['department'];
        $sqlVal['login_id']    = $arrMemberData['login_id'];
        $sqlVal['password']    = SC_Utils_Ex::sfGetHashString($arrMemberData['password'], $salt);
        $sqlVal['salt']        = $salt;
        $sqlVal['authority']   = $arrMemberData['authority'];
        $sqlVal['rank']        = $objQuery->max('rank', 'dtb_member') + 1;
        $sqlVal['work']        = $arrMemberData['work'];
        $sqlVal['del_flg']     = '0'; // 削除フラグをOFFに設定
        $sqlVal['creator_id']  = $_SESSION['member_id'];
        $sqlVal['create_date'] = 'NOW()';
        $sqlVal['update_date'] = 'NOW()';

        // INSERTの実行
        $sqlVal['member_id'] = $objQuery->nextVal('dtb_member_member_id');
        $objQuery->insert('dtb_member', $sqlVal);
    }

    /**
     * 管理者データをUpdateする.
     *
     * @param array 管理者データの連想配列
     * @return void
     */
    function updateMemberData($member_id, $arrMemberData) {
        $objQuery =& SC_Query::getSingletonInstance();

        // Updateする値を作成する.
        $sqlVal = array();
        $sqlVal['name']        = $arrMemberData['name'];
        $sqlVal['department']  = $arrMemberData['department'];
        $sqlVal['login_id']    = $arrMemberData['login_id'];
        $sqlVal['authority']   = $arrMemberData['authority'];
        $sqlVal['work']   = $arrMemberData['work'];
        $sqlVal['update_date'] = 'NOW()';
        if($arrMemberData['password'] != DEFAULT_PASSWORD) {
            $salt = SC_Utils_Ex::sfGetRandomString(10);
            $sqlVal['salt']     = $salt;
            $sqlVal['password'] = SC_Utils_Ex::sfGetHashString($arrMemberData['password'], $salt);
        }

        $where = "member_id = ?";

        // UPDATEの実行
        $objQuery->update("dtb_member", $sqlVal, $where, array($member_id));
    }
}
?>
