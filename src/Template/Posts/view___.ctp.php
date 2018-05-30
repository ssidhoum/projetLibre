<div class="infoPost"> 
                    
                        <table class="tablePost">
                                <tr>
                            <td>    
                                <?php if(in_array($post->id, $this->request->session()->read('Auth.Like'))) :?>
                                    <i class="fas fa-times"></i>
                                    <?= $this->Html->link("Je n'aime plus ", array('controller' => 'posts', 'action' => 'unlike', $post->id)); ?>
                                <?php else: ?>
                                    <i class="fas fa-heart"></i>
                                    <?= $this->Html->link("J'aime ", array('controller' => 'posts', 'action' => 'like', $post->id)); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                Aimé par :
                                <?php foreach ($like as $likes): ?>
                                    <?= $likes->has('user') ? $this->Html->link("   ".$likes->user->firstname, ['controller' => 'Users', 'action' => 'view', $likes->user->id]) : '' ?>
                                <?php endforeach ?>
                            </td>
                            </tr>
                            <tr>
                            <td>
                                <i class="fas fa-comment"></i>
                                <?= $this->Html->link("Je commente ", array('controller' => 'comments', 'action' => 'add', $post->id)); ?>
                            </td>      
                            </tr>
                        </table>
                    
                    
                    <table class="tableComment">
                        <tr>
                            <td>

                                Les commentaires:
                            
                            </td>
                        
                        <?php foreach ($comment as $comments): ?>
                        
                            
                            <td>
                                <?= $comments->has('user') ? $this->Html->link("   ".$comments->user->firstname, ['controller' => 'Users', 'action' => 'view', $comments->user->id]) : '' ?> : 
                            </td>                    
                        
                        
                            <td>
                                <?= $comments->content ?>
                            </td>         
                        
                            <td>
                                le: <?= $comments->created ?>
                            </td>
                            <?php endforeach?>
                        </tr>
                        
                    </table>   
                </div>