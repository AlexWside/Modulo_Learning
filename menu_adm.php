                <div class="botoes-post text-center" style="display: flex;align-items: center; justify-content:center;">
                <?php if($item[11] == 0){  ?>
                      <form style="float:right" action="desativar_curso" method="POST">
                      <input type="hidden" name="id" value=<?= $item[0]?>>
                      <input type="hidden" name="url" value='home'>
                      <button title="Desativar"  class="btn btn-success " type="submit" ><i class="fas fa-power-off"></i></button>
                      </form>

                      <?php } else { ?>
                      <form style="float:right" action="ativar_curso" method="POST">
                      <input type="hidden" name="id" value=<?= $item[0]?>>
                      <input type="hidden" name="url" value='home'>
                      <button title="Ativar"  class="btn btn-danger " type="submit" ><i class="fas fa-power-off"></i></button>
                      </form>
                        <?php  } ?>
                      <form style="float:right" action="editar_descricao" method="POST">
                      <input type="hidden" name="id_curso" value=<?= $item[0]?>>
                      <input type="hidden" name="url" value='home'>
                      <button title="Editar"  class="btn btn-info " type="submit" ><i class="fas fa-edit"></i></button>
                      </form>
                      <form style="float:right" action="permissoes_video" method="POST">
                      <input type="hidden" name="id_curso" value=<?= $item[0]?>>
                      <input type="hidden" name="url" value='home'>
                      <button title="Permissões"  class="btn btn-warning " type="submit" ><i class="fas fa-users"></i></button>
                      </form>
                      <form style="float:right" action="views" method="POST">
                      <input type="hidden" name="id_curso" value=<?= $item[0]?>>
                      <input type="hidden" name="url" value='home'>
                      <button title="Visualizações"   class="btn btn-primary " type="submit" ><i class="far fa-eye"></i></button>
                      </form>
                      
                  </div>
                  <div class="text-center">
                  <h6 style="color:blue;">Permissões de Administrador</h6>
                  </div>
                  
                  