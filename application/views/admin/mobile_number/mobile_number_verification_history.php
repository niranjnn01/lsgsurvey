<?php showMessage();?>


<div class="row">
	<div class="col-md-12">
		
		This page is to be used for debugging scenarios. To see history of SMS sent to a mobile number for verification purpose.
		Accessed by admin user.
	</div>
</div>


<?php if($aData):?>
<table class="table table-condensed">

    <thead>
		<tr>
			<th>SI</th>
			<th>Account No</th>
			<th>Mobile Number</th>
			<th>Token Id</th>
			<th>Token</th>
			<th>
				User Mobile
				<br/>
				verification Status</th>
			<th>SMS Sent Status</th>
			<th>Sent on</th>
			<th>Expires in (seconds)</th>
			
		</tr>
    </thead>
	
    <tbody>
	<?php foreach($aData AS $iKey => $oItem):?>
    <tr>

	    <td>
			<?php echo $iKey + 1;?>
		</td>
		<td>
			<?php echo $oItem->account_no;?>
		</td>
		
		<td>
			<?php echo $oItem->mobile_number;?>
		</td>
		
		
		<td>
			<?php echo $oItem->token_id;?>
			
		</td>
		
		<td>
			<?php echo $oItem->token;?>
			
		</td>
		
		<td>
			<?php echo $aUserMobileVerificationStatusTitle[$oItem->mobile_verification_status];?>
			
		</td>
		
		<td>
			<?php echo $aSmsSentStatusTitle[$oItem->sent_status];?>
			
		</td>
		
		<td>
			<?php echo date('jS M, Y', strtotime($oItem->sent_on));?>
			
		</td>
		<td>
			<?php $iSeconds = strtotime($oItem->expires_on) - time(); ?>
			<?php echo ($iSeconds < 0) ? "Expired" : $iSeconds;?>
			
		</td>
		
		
    </tr>
	<?php endforeach;?>
    </tbody>
</table>

<?php else:?>
<div class="col-md-10 pull-center">There is no history . (SMS History is cleared once a mobile number is verified)</div>
<?php endif;?>

