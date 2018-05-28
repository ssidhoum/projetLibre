<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>

 <div class="containerHome">

        <div class="navProfil">
            <nav class="cl-effect-13">
                <ul class="navAccount">
                    <li<?php if($this->request->action == 'home'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-home"></i>
                        <?= $this->Html->link('Accueil', array('controller' => 'users', 'action' => 'home')); ?>
                    </li>
                    <li<?php if($this->request->action == 'view'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-user-circle"></i>
                        <?= $this->Html->link('Mon profil', array('controller' => 'users', 'action' => 'view', 3)); ?>
                    </li>
                    <li<?php if($this->request->action == 'account'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-cog"></i>
                        <?= $this->Html->link('Mes paramètres', array('controller' => 'users', 'action' => 'account')); ?>
                    </li>
                    <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-envelope"></i>
                        <?= $this->Html->link('Messagerie', array('controller' => 'messages', 'action' => 'inbox')); ?>
                    </li>
                    <li<?php if($this->request->action === 'my'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-paw"></i>
                        <?= $this->Html->link('Mes animaux', array('controller' => 'pets', 'action' => 'my')); ?>
                    </li>
                    <li<?php if($this->request->action == 'edit'): ?> class="active"<?php endif; ?>>
                        <i class="fas fa-plus-circle"></i>
                        <?= $this->Html->link('Ajouter une photo', array('controller' => 'posts', 'action' => 'edit')); ?>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="flexLayout">
            <div class="tableMsg">
                <h2>
                    Boite de réception
                </h2>
        	    <table>
        		<?php foreach ($messages as $message) : ?>
        			<tr>
                        <td>
                            <?php if($message->status==0) : ?>
                                <i class="fas fa-envelope"></i>
                            <?php else: ?>
                                <i class="fas fa-envelope-open"></i>
                            <?php endif ?>
                        </td>
        				<td>
        					<?= 
                                $message->sender_id 
                            ?>

                            <?= 
                                $message->has('user') ? $this->Html->link($message->user->firstname, ['controller' => 'Users', 'action' => 'view', $message->user->id]) : '' 
                            ?>
                            
        				</td>
        				<td>
        					
        				</td>
                        <td>
                            <?php 
                                $contenu= $message->body;
                                $extrait= substr($contenu,0, 10).'...';
                                echo $this->Html->link($extrait, array('controller' => 'messages', 'action' => 'view', $message->id)); 
                            ?> 
                        </td>

                        
                        <td>
                            <?php
                                $date= new DateTime(h( $message->created));
                                $diff= $date->diff(new DateTime('now'))->format('%y Years, %m Months, %d Days');

                                $diffYears= $date->diff(new DateTime('now'))->format('%y');
                                $diffDays= $date->diff(new DateTime('now'))->format('%d');
                                $diffMonths= $date->diff(new DateTime('now'))->format('%m');

                                if ($diffYears == 0){
                                    if ($diffMonths == 0){
                                        if($diffDays == 0){
                                            echo 'ajourdhui';
                                        }
                                        elseif($diffDays >=1 AND $diffDays <= 6){
                                            echo $diffDays.'jours';
                                        }
                                        elseif($diffDays >=7 AND $diffDays <= 9){
                                            echo '1 semaine';
                                        }
                                        elseif($diffDays >=10 AND $diffDays <= 14){
                                            echo $diffDays.'jours';
                                        }
                                        elseif($diffDays >=15 AND $diffDays <= 18){
                                            echo 'deux semaines';
                                        }
                                        elseif($diffDays >=18 AND $diffDays <= 29){
                                            echo $diffDays.'jours';
                                        }
                                        elseif($diffDays >=30 AND $diffDays <= 31){
                                            echo 'un mois';
                                        }
                                    }
                                    else{
                                        echo $diffMonths.'mois, et '.$diffDays.'jours. ';
                                    }    
                                }
                                else{
                                    echo $diffYears."an, ".$diffMonths.' mois, et '.$diffDays.'jours.';
                                }
                                ?>

                        </td>  
        			</tr>
        		<?php endforeach  ?>
        	   </table>
            </div>
            <div class="menuMessagerie">
                <nav class="cl-effect-13">
                    <ul class="navMessagerie">
                        <li<?php if($this->request->action == 'inbox'): ?> class="active"<?php endif; ?>>
                            <i class="fas fa-envelope"></i>
                            <?= $this->Html->link('Boite de reception', array('controller' => 'messages', 'action' => 'inbox')); ?>
                        </li>
                        <li<?php if($this->request->action == 'outbox'): ?> class="active"<?php endif; ?>>
                            <i class="fas fa-paper-plane"></i>
                            <?= $this->Html->link('Messages envoyés', array('controller' => 'messages', 'action' => 'outbox')); ?>
                        </li>
                        <li<?php if($this->request->action == 'compose'): ?> class="active"<?php endif; ?>>
                            <i class="fas fa-edit"></i>
                            <?= $this->Html->link('Rédiger un message', array('controller' => 'messages', 'action' => 'compose')); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
</div>