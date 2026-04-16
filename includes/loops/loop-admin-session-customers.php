
<form class="table-form">
    <input type="hidden" name="form_action" value="customer_update"/>
    <input type="hidden" name="post_id" value="<?= $mySession->id ?>"/>
    <table>
        <caption>Liste des inscrits</caption>
        <thead>
            <tr>
                <th><input type='checkbox' onClick="checkAll(this, 'customerId[]')"></th>
                <th>Prénom</th><th>Nom</th>
                <th>Type</th>
                <th>Inscrit le</th>
                <th>Chèque</th>
                <th>mondpc</th>
                <th>Statut</th>
                <th>Eval 1</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée</th>
                <th>Eval 2</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Durée</th>
                <th>Durée totale</th>
                <th>Présence</th>
                <th>Satisfaction</th>
            </tr>
        </thead>
        <tbody>
                <?php
                $customers = $mySession->getCustomers();
                //var_dump($customers);
                foreach($customers as $customerId)
                {

                    $customer = new User($customerId);
                    date_default_timezone_set('Europe/Paris');
                    $timestamp = strtotime($mySession->getCustomerDateCreated($customerId));
                    echo "<tr>";
                    echo "<td>";
                    echo "<input type='checkbox' name='customerId[]' class='checkbox' value='".$customerId."'' id='customer".$customerId."'/>";
                    echo "</td>";
                    echo "<td>";
                    echo $customer->firstname;
                    echo "</td>";
                    echo "<td>";
                    echo $customer->lastname;
                    echo "</td>";
                    echo "<td>";
                    echo $customer->type;
                    echo "</td>";
                    echo "<td>";
                    echo date('d-m-Y G:i:s', $mySession->getCustomerDateCreated($customerId));
                    echo "</td>";
                    echo "<td>";
                    //echo get_field('member_paycheck_limit', "user_1387");
                    //echo $customerId;
                    echo getStatusIcon($customer->paycheck_IsValid(),$customer->paycheck_limit);
                    echo "</td>";
                    echo "<td>";
                    echo getStatusIcon($mySession->getDPC($customerId)+1, $mySession->getDPC($customerId));
                    echo "</td>";
                    echo "<td>";
                    echo getStatusIcon($mySession->getCustomerStatus($customerId), $mySession->getCustomerStatusNiceName($customerId));
                    echo "</td>";
                    echo "<td>";
                    if($mySession->evaluation_type == "app+epp"){
                        $app = new Quiz($mySession->app_form['id']);
                        $epp = new Quiz($mySession->epp_form['id']);
                        $epp_max = $mySession->epp_number;
                        $app_count = $app->countUserFormEntries($customerId, 1, $mySession->id);
                        $epp_count = $epp->countUserFormEntries($customerId, 1, $mySession->id);
                        echo getStatusIcon($mySession->getCustomer_eval_1_status($customerId), "App : ".$app_count." - Epp : ".$epp_count."/".$epp_max);
                    } elseif($mySession->evaluation_type == "epp"){
                        $epp = new Quiz($mySession->epp_form['id']);
                        $epp_count = $epp->countUserFormEntries($customerId, 1, $mySession->id);
                        $epp_max = $mySession->epp_number;
                        echo getStatusIcon($mySession->getCustomer_eval_1_status($customerId), "Epp : ".$epp_count."/".$epp_max);
                    } else {
                        echo getStatusIcon($mySession->getCustomer_eval_1_status($customerId), getStatusNiceName($mySession->getCustomer_eval_1_status($customerId)));
                    }                    
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getSessionEvalDebut($customerId, 1);
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getSessionEvalEnd($customerId, 1);
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getCustomer_eval_1_duration($customerId);
                    echo "</td>";
                    echo "<td>";
                    if($mySession->evaluation_type == "app+epp"){
                        $app = new Quiz($mySession->app_form['id']);
                        $epp = new Quiz($mySession->epp_form['id']);
                        $epp_max = $mySession->epp_number;
                        $app_count = $app->countUserFormEntries($customerId, 2, $mySession->id);
                        $epp_count = $epp->countUserFormEntries($customerId, 2, $mySession->id);
                        echo getStatusIcon($mySession->getCustomer_eval_2_status($customerId), "App : ".$app_count." - Epp : ".$epp_count."/".$epp_max);
                    } elseif($mySession->evaluation_type == "epp"){
                        $epp = new Quiz($mySession->epp_form['id']);
                        $epp_count = $epp->countUserFormEntries($customerId, 2, $mySession->id);
                        $epp_max = $mySession->epp_number;
                        echo getStatusIcon($mySession->getCustomer_eval_2_status($customerId), "Epp : ".$epp_count."/".$epp_max);
                    } else {
                        echo getStatusIcon($mySession->getCustomer_eval_2_status($customerId), getStatusNiceName($mySession->getCustomer_eval_2_status($customerId)));
                    }  
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getSessionEvalDebut($customerId, 2);
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getSessionEvalEnd($customerId,2);
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getCustomer_eval_2_duration($customerId);
                    echo "</td>";
                    echo "<td>";
                    echo $mySession->getCustomer_eval_all_duration($customerId);
                    echo "</td>";
                    echo "<td>";
                    echo getStatusIcon($mySession->getCustomerAttendance($customerId), getStatusNiceName($mySession->getCustomerAttendance($customerId)));
                    echo "</td>";
                    echo "<td>";
                    echo getStatusIcon($mySession->getCustomer_satisfaction_status($customerId), getStatusNiceName($mySession->getCustomer_satisfaction_status($customerId)));
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="15" class="table-actions">
                    <select name="update_action">
                        <option disabled selected>Choisir une action</option>
                        <optgroup>
                            <option value="0">Inscription invalide</option>
                            <option value="1">Inscription en attente</option>
                            <option value="2">Inscription validée</option>
                        </optgroup>
                        <optgroup>
                            <option value="10">Inscrit sur mondpc.fr</option>
                            <option value="11">Annuler inscription mondpc.fr</option>
                            <!--<option value="95">Dossier reçu</option>
                            <option value="96">Annuler dossier reçu</option>-->
                        </optgroup>
                        <optgroup>
                            <option value="20">Supprimer Evaluation 1</option>
                            <option value="21">Supprimer Evaluation 2</option>
                            <option value="22">Valider Evaluation 1</option>
                            <option value="23">Valider Evaluation 2</option>
                            <option value="24">Invalider Evaluation 1</option>
                            <option value="25">Invalider Evaluation 2</option>
                        </optgroup>
                        <optgroup>
                            <option value="30">Valider présence</option>
                            <option value="31">Annuler présence</option>
                        </optgroup>
                        <optgroup>
                            <option value="93">Renvoyer mail de rappel MONDPC</option>
                            <option value="95">Renvoyer mail de pré-inscription</option>
                            <option value="96">Renvoyer mail d'inscription validée</option>
                            <option value="94">Renvoyer mail de rappel</option>
                            <option value="92">Envoyer email "documents téléchargeables"</option>
                        </optgroup>
                        <optgroup>
                            <option value="97">Relancer EVAL 1 par email</option>
                            <option value="98">Relancer EVAL 2 par email</option>
                        </optgroup>
                        <optgroup>
                            <option value="99">Supprimer l'utilisateur</option>
                        </optgroup>
                        </select>
                    <button class="btn btn-turquoise btn-small">Valider</button>
                    <a class="btn btn-turquoise btn-small" href="./?action=export_session_data&post_id=<?= $mySession->id ; ?>&customer_id=<?= $customerId; ?>">Exporter les données</a>
                    <a class="btn btn-turquoise btn-small" href="./?action=export_session_data_2&post_id=<?= $mySession->id ; ?>&customer_id=<?= $customerId; ?>">Exporter les données pour mondpc</a>
                </td>
            </tr>
        </tfoot>
    </table>
</form>
