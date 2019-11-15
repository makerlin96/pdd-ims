<?php


namespace app\admin\controller;
use app\admin\controller\Common;
use pdd\PddApi;
use app\admin\model\Goods as goodsModel;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\Validate;
use app\admin\model\Duo;

class Goods extends Common
{
    /***
     * 已导入商品列表页
     * @return mixed|void
     * @throws DbException
     */
    public function goodsList()
    {
        if($this->request->isAjax())
        {
            $goodsList = [];
            //获取搜索参数
            $param = [
                'goodsName' => $this->request->post('goodsName','','trim'),
                'mallName'  => $this->request->post('mallName','','trim'),
                'limit'     => $this->request->post('limit','15','trim')
            ];
            if($this->uid === 1) {
                $list = goodsModel::withSearch(['goods_name', 'mall_name'], [
                    'goods_name' => $param['goodsName'],
                    'mall_name' => $param['mallName']
                ])->paginate($param['limit'], false, ['query' => $param]);

            }else{
                $list = goodsModel::withSearch(['goods_name', 'mall_name'], [
                    'goods_name' => $param['goodsName'],
                    'mall_name' => $param['mallName']
                ])->whereOr('be_in_charge_of','=',$this->uid)->paginate($param['limit'], false, ['query' => $param]);
            }
            foreach ($list as $key => $value) {
                $userName = \app\admin\model\User::get(['uid' => $value['be_in_charge_of']]);
                $value['be_in_charge_of'] = $userName['name'];
                $goodsList[] = $value;
            }
            return show($goodsList,0,'',['count'=>$list->total()]);
        }
        return $this->fetch();
    }

    /****
     * 拼多多商品搜索
     * @return mixed|void
     */
    public function pddGoodsSearch()
    {
        $pddApi = new PddApi();
        if($this->request->isAjax())
        {
            $param=[
                'keyword' => $this->request->post('goodsName','','trim'),
                'sort_type'=>$this->request->post('sortType',0,'trim'),
                'with_coupon'=>$this->request->post('withCoupon',false,'trim'),
                'cat_id'=>$this->request->post('cat','','trim'),
                'merchant_type'=>$this->request->post('merchantType','','trim'),
                'page'=>$this->request->post('page','1','trim'),
                'page_size'=>$this->request->post('limit','15','trim')
            ];
            if(empty($param['keyword']))
            {
                unset($param['keyword']);
            }
            if($param['sort_type'] === 0)
            {
                unset($param['sort_type']);
            }
            if($param['with_coupon'] === false)
            {
                unset($param['with_coupon']);
            }
            if($param['cat_id'] === '')
            {
                unset($param['cat_id']);
            }
            if($param['merchant_type'] === '1')
            {
                unset($param['merchant_type']);
            }
            $data = $pddApi->getPddData('pdd.ddk.goods.search',$param);
            $data = json_decode($data,true);

            if(isset($data['error_response']))
            {
                return show($data['error_response'],1,$data['error_response']['error_msg']);
            }else{
                return show($data['goods_search_response']['goods_list'],0,'查询成功:)',['count'=>$data['goods_search_response']['total_count']]);
            }
        }
        $cats = $pddApi->getPddData('pdd.goods.cats.get',['parent_cat_id'=>0]);
        $cats = json_decode($cats,true);
        if(isset($cats['error_response']))
        {
            return $cats['error_response'];
        }else{
            $goods_cats_list = $cats['goods_cats_get_response']['goods_cats_list'];
            $this->assign('cats',$goods_cats_list);
        }
        return $this->fetch();
    }

    /***
     * 查询商品推广计划
     * @param string $goodsId
     * @param string $zsDuoId
     */
    public function getGoodsPlan($goodsId = '0',$zsDuoId='0')
    {
        $pddApi = new PddApi();
        $param = [
            'goods_id'=>$goodsId,
            'zs_duo_id'=>$zsDuoId
        ];
        if($param['zs_duo_id'] === 0 || $param['zs_duo_id'] === '0')
        {
            unset($param['zs_duo_id']);
        }
        $goodsPlans = $pddApi->getPddData('pdd.ddk.goods.unit.query',$param);
        return json_decode($goodsPlans,true);
    }

    public function goodsPlan()
    {

    }

    /****
     * 商品导入操作
     * @return array|int
     * @throws \Exception
     */
    public function importGoodsInfo()
    {
        //var_dump($this->request->post());
        $postData = $this->request->post();
        $goods = [];
        $validate = validate('Goods');
        $errorInfo = [];
        foreach ($postData['data'] as $key => $value)
        {
            if(!$validate->check($value))
            {
                $errorInfo[] = $value['goods_name'] . $validate->getError();
                continue;
            }else{
                $goods[] = $value;
                $goods[$key]['goods_status'] = '未分配';
                $goods[$key]['be_in_charge_of'] = 'admin';
                //var_dump($value);
                //$goods[$key]['service_tags'] = json_encode($goods[$key]['service_tags']);
                //$goods[$key]['opt_ids'] = json_encode($goods[$key]['opt_ids']);
                //$goods[$key]['cat_ids'] = json_encode($goods[$key]['cat_ids']);
            }
        }
        $goodsModel = new goodsModel();
        $goodsModel->saveAll($goods);
        //var_dump($goods);
        if(empty($errorInfo))
        {
            return 1;
        }else{
            return $errorInfo;
        }
    }


    public function contact()
    {
        if ($this->request->isAjax())
        {
            $goods_id = $this->request->post('goods_id');
            /*$goodsModel = new goodsModel();*/
            $goods = goodsModel::get(['goods_id'=>$goods_id]);
            //var_dump($goods);
            if($goods_id)
            {
                $count = $goods->is_contact;
                $goods->is_contact = $count + 1;
                $goods->save();
                return 1;
            }else{
                return 0;
            }
        }else{
            $this->uid=null;
            return $this->error('非法访问！','/admin');
        }
    }



    /***
     * @return mixed
     */
    public function missionAssign()
    {
        if($this->request->isAjax())
        {
            $uid = $this->request->post('uid');
            $count = $this->request->post('count');
            $query = "UPDATE think_goods SET goods_status = '已分配' , be_in_charge_of = ".$uid." WHERE goods_status = '未分配' OR goods_status = '' ORDER BY id DESC LIMIT ".$count;
            $res = Db::execute($query);
            return $res;
        }
        $users = Db::query("SELECT A.uid,A.name FROM think_user AS A
                       JOIN think_auth_group_access AS B ON A.uid = B. uid
                       WHERE B.group_id = 2");
        //var_dump($users);
        $sum  = \app\admin\model\Goods::where('goods_status','=','未分配')->count();
        $this->assign('sum',$sum);
        $this->assign('users',$users);
        return $this->fetch();
    }
}