<?
class menu
{
	var $menu;
	var $stt 			= -1;
	var $show_count 	= 0;
	var $arrayCatId 	= array();
	var $countId		= 1;
	var $arrayParent 	= array();
	var $arrayCategory 	= array();
	var $level 			= array(0,0,0,0,0,0,0,0,0,0);
	var $arrayCount		= array();
	/*
	//nâng cấp bởi dinhtoan1905
	getAllChild : lay het menu con
	
	Parameter
	$table_name			: Ten bang
	$id_field			: truong id (vd:mnu_id)
	$parent_id_field	: truong parent_id (vd : mnu_parent_id)
	$parent_id			: id cua nu't cha
	$where_clause		: Menh de where trong cau query
	$field_list			: danh sach truong can lay cach nhau = dau ,
	$order_clause		: sap xep theo gi` (sql)
	$has_child_field	: ten truong xac nhan tree do co' con hay ko (vd: mnu_has_child)
	$update				: co update has_child vao database hay khong
	*/
	
    /*
	//nâng cấp bởi dinhtoan1905
	sortLevel : Hàn sắp xếp các cấp con cho đúng vị trí
	
	Parameter
	$arrayCategory		: array chứa các mục
	$keystart			: nút cha
	$level				: Menh de where trong cau query
	*/
	function getAllRecodeNew($table_name,$id_field,$parent_id_field,$parent_id,$where_clause,$field_list,$order_clause,$has_child_field=0,$update=1,$level=0,$callback=0){
        //$query=;
        $db_category1 = new db_query("SELECT " . $field_list .
										" FROM " . $table_name .
										" WHERE " . $where_clause . 
										" ORDER BY " . $id_field . " ASC," . $order_clause);
                                        $db_category1 = new db_query($query);
        while($row=mysql_fetch_assoc($db_category1->result)){
			//if(intval($row[$id_field]) == intval($row[$parent_id_field])){
				//$db_ex = new db_execute("UPDATE " . $table_name . " SET " . $parent_id_field . " = 0 WHERE " . $id_field . " = " . $row[$id_field]);
				//unset($db_ex);
			//}else{
				$this->arrayCategory[] =  $row;
				$this->arrayCategory[]["count"] =  '';
			//}
		}
		unset($db_category);
        //var_dump($query);die();                                
        return $this->menu;
        $this->arrayCategory = array();
		
    }
	/*
	//nâng cấp bởi dinhtoan1905
	sortLevel : Hàn sắp xếp các cấp con cho đúng vị trí
	
	Parameter
	$arrayCategory		: array chứa các mục
	$keystart			: nút cha
	$level				: Menh de where trong cau query
	*/
	

	/*
	getAllChild_no_hasChildField : lay het menu con nhung ko co truong hasChild
	
	Parameter
	$table_name			: Ten bang
	$id_field			: truong id (vd:mnu_id)
	$parent_id_field	: truong parent_id (vd : mnu_parent_id)
	$parent_id			: id cua nu't cha
	$where_clause		: Menh de where trong cau query
	$field_list			: danh sach truong can lay cach nhau = dau ,
	$order_clause		: sap xep theo gi` (sql)
	*/
	


	/*
	getChild : lay menu con
	
	Parameter
	$table_name			: Ten bang
	$id_field			: truong id (vd:mnu_id)
	$parent_id_field	: truong parent_id (vd : mnu_parent_id)
	$parent_id			: id cua nu't cha
	$where_clause		: Menh de where trong cau query
	$field_list			: danh sach truong can lay cach nhau = dau ,
	$order_clause		: sap xep theo gi` (sql)
	*/
	


	/*
	getOpenNode : Lay menu cua 1 nu't nao do
	
	Parameter
	$table_name			: Ten bang
	$id_field			: truong id (vd:mnu_id)
	$parent_id_field	: truong parent_id (vd : mnu_parent_id)
	$parent_id			: id cua nu't cha
	$where_clause		: Menh de where trong cau query
	$field_list			: danh sach truong can lay cach nhau = dau ,
	$order_clause		: sap xep theo gi` (sql)
	$array_parent_node: mang cac nut cha
	*/
	
	
	
	/*
	getAllParent : Lay ta ca cac nut cha
	
	$table_name			: Ten bang
	$id_field			: truong id (vd:mnu_id)
	$parent_id_field	: truong parent_id (vd : mnu_parent_id)
	$id					: id cua nu't can lay danh sach cha
	*/
	
	
	//get all parent city
	
	
	//get all parent list
	
	
	// lay cap cha cao nhat dang select
	//end function 
	
	//gan du lieu vao mot array (dinhtoan1905)
	
	
	
	//lay category cap cha cao nhat (dinhtoan1905)
	

	//lay tat ca cap con (dinhtoan1905)
	
	/*
		dinhtoan1905
		ham tinh count cua san pham
		ham nay chi chay sau khi goi ham getArray
	*/
	

	/*
	dinhtoan1905
	tao ra javascript multi combobox
	vi du 
	$mymenu = new menu();
	echo $mymenu->getComboxJava("categories_multi","cat_id","cat_name","cat_parent_id"," cat_type = 'product'");
	$arrayParent = $mymenu->arrayParent;
	*/
	
}
?>