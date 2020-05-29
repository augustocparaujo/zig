<form method="post" action="<?php echo isset($cliente->id) ? BASEURL.'/clienteEndereco/update' : BASEURL.'/clienteEndereco/save';?>"
	enctype='multipart/form-data'>
	<div class="row">

		<?php if (isset($clienteEndereco->id)):?>
			<input type="hidden" name="id" value="<?php echo $clienteEndereco->id;?>">
		<?php endif;?>

		<input type="hidden" name="id_cliente" value="<?php echo $idCliente;?>">
		
		<div class="col-md-4">
		    <div class="form-group">
		        <label for="cep">CEP*</label>
		        <input type="text" class="form-control" name="cep" id="cep" placeholder="Digite o CEP!" 
		        value="<?php echo isset($clienteEndereco->id) ? $clienteEndereco->cep : ''?>">
		    </div>
		</div>

		<div class="col-md-4">
		    <div class="form-group">
		        <label for="endereco">Endereço *</label>
		        <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Digite o endereço!" 
		        value="<?php echo isset($clienteEndereco->id) ? $clienteEndereco->endereco : ''?>">
		    </div>
		</div>

		<div class="col-md-4">
		    <div class="form-group">
		        <label for="bairro">Bairro *</label>
		        <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Digite o bairro!" 
		        value="<?php echo isset($clienteEndereco->id) ? $clienteEndereco->bairro : ''?>">
		    </div>
		</div>

		<div class="col-md-4">
		    <div class="form-group">
		        <label for="numero">Número</label>
		        <input type="text" class="form-control" name="numero" id="numero" placeholder="Exemplo: 14-E" 
		        value="<?php echo isset($clienteEndereco->id) ? $clienteEndereco->numero : ''?>">
		    </div>
		</div>

		<div class="col-md-4">
		    <div class="form-group">
		        <label for="estado">Estado</label>
		        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado!" 
		        value="<?php echo isset($clienteEndereco->id) ? $clienteEndereco->estado : ''?>">
		    </div>
		</div>

		<div class="col-md-4">
		    <div class="form-group">
		        <label for="cidade">Cidade</label>
		        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade!" 
		        value="<?php echo isset($clienteEndereco->id) ? $clienteEndereco->cidade : ''?>">
		    </div>
		</div>

		<div class="col-md-12">
		    <div class="form-group">
		        <label for="complemento">Complemento</label>
		        <textarea class="form-control" name="complemento" id="complemento" 
		        placeholder="Complemento..." 
		        ><?php echo isset($clienteEndereco->id) ? $clienteEndereco->complemento : ''?></textarea>
		    </div>
		</div>

    </div><!--end row-->

	<button type="submit" class="btn btn-success btn-sm" style="float:right">
		<i class="fas fa-save"></i> Salvar
	</button>

</form>

<script>
	
	<?php if (isset($cliente->id)):?>
		<?php if ($cliente->id_cliente_tipo == 1):?>

			$("#cnpj").attr('disabled','disabled');
			$("#id_cliente_segmento").attr('disabled','disabled');
			$("#cpf").attr('disabled', false);

		<?php elseif ($cliente->id_cliente_tipo == 2):?>

			$("#cnpj").attr('disabled', false);
			$("#id_cliente_segmento").attr('disabled', false);
			$("#cpf").attr('disabled', 'disabled');

		<?php endif;?>
    <?php endif;?>
	
</script>