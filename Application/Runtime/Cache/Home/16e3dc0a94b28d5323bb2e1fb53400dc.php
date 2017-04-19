<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
		<title>南苑计协维修系统</title>
		<link rel="stylesheet" type="text/css" href="/repair_system/Public/css/bootstrap.min.css">
		<style type="text/css">
			.header {
				width:100%;
				height:50px;
				line-height: 50px;
				background-color: #999;
				color:#fff;
			}
			.content {
				margin-top:20px;
			}
			.row{
			}
		</style>
	</head>
	<body>

		<div align="center" class="header">
			<div style="position: absolute;left:5px">
				<a href="<?php echo U('Home/CheckOrder/checkOrderView');?>" class="btn btn-warning">
					报修列表
				</a>
			</div>
			计协电脑报修
		</div>

		<div style="width:90%;margin-left: 5%" class="content">
			<form class="form-horizontal">
				<div class="form-group">
			    	<label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
			    	<div class="col-sm-10">
			      		<input type="text" id="name" class="form-control" value="<?php echo ($user['name']); ?>">
			    	</div>
			 	</div>
			 	<div class="form-group">
			    	<label for="inputEmail3" class="col-sm-2 control-label">学号</label>
			    	<div class="col-sm-10">
			      		<input type="text" id="student_number" class="form-control" value="<?php echo ($user['student_number']); ?>" placeholder="方便维修人员统计">
			    	</div>
			 	</div>
				<div class="form-group">
			    	<label for="inputEmail3" class="col-sm-2 control-label">服务类型</label>
			    	<div class="col-sm-10">
			      		<!-- <input type="text" id="service_type" class="form-control"> -->
			      		<select style="background-color: #fff;border:1px #eee solid;width:100%;height:30px" name="" id="service_type">
			      			<option value=""></option>
			      			<?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type['name']); ?>">
									<?php echo ($type['name']); ?>
								</option><?php endforeach; endif; else: echo "" ;endif; ?>
			      		</select>
			    	</div>
			 	</div>
			 	<div class="form-group">
			    	<label for="inputEmail3" class="col-sm-2 control-label">电脑类型</label>
			    	<div class="col-sm-10">
			      		<input type="text" id="computer_type" class="form-control">
			    	</div>
			 	</div>
			 	<div class="form-group">
			    	<label for="inputEmail3" class="col-sm-2 control-label">详情</label>
			    	<div class="col-sm-10">
			      		<input type="text" id="content" class="form-control">
			    	</div>
			 	</div>
			</form>

			<div align="center">
				<button class="btn btn-primary" style="width:70%" onclick="addOrder()">
					提交
				</button>
			</div>
		</div>

		<div style="visibility: hidden" hidden>
			<div id="addOrderAjax">
				<?php echo U('Home/Index/addOrderAjax');?>
			</div>
			<div id="auth">
				<?php echo U('Home/Index/auth');?>
			</div>
			<div id="myOrder">
				<?php echo U('Home/CheckOrder/checkOrderView');?>
			</div>
		</div>
		
		<script type="text/javascript" src="/repair_system/Public/js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="/repair_system/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			var addOrder = function(){
				var data = {
					content:$('#content').val(),
					computer_type:$('#computer_type').val(),
					service_type:$('#service_type').val(),
					name:$('#name').val(),
					student_number:$('#student_number').val()
				}

				for(var i in data){
					if(data[i] == '' || data[i] == undefined){
						alert('请填写完整数据');
						return ;
					}
				}

				$.ajax({
					url:$('#addOrderAjax').html(),
					type:"post",
					data:data,
					success:function(res){
						if(res.success){
							alert(res.msg);
							window.location.href = $('#myOrder').html();
						}else {
							if(res.errmsg == '请先验证用户'){
								window.location.href = $('#auth').html();
							}else {
								alert(res.errmsg);
							}
						}
					},
					error:function(){
						alert('网络错误');
					}
				})
			}
		</script>
	</body>
</html>