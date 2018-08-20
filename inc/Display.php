<?php
/**
*@package ChalkNFLPlugin
*/

namespace Inc;

class Display {

    function display() {
            
            $request = wp_remote_get( 'http://delivery.chalk247.com/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0' );

            if( is_wp_error( $request ) ) {
                return false; 
            }

            $body = wp_remote_retrieve_body( $request );
            $data = json_decode( $body );
            $team_list = $data->results->data->team;
            $afcNorth = array();
            $afcEast = array();
            $afcSouth = array();
            $afcWest = array();
            $nfcNorth = array();
            $nfcEast = array();
            $nfcSouth = array();
            $nfcWest = array();
                
                if( ! empty( $data ) ) {
                    
                    //Divide teams into arrays by conference and division
                    foreach ( $team_list as $team ) {
                        if ( $team->conference == "NFC" ): 
                            if ( $team->division == "North" ):
                                array_push( $nfcNorth, $team->name );
                            elseif ( $team->division == "East" ):
                                array_push( $nfcEast, $team->name );
                            elseif ( $team->division == "West" ):
                                array_push( $nfcWest, $team->name );
                            else:
                                array_push( $nfcSouth, $team->name );
                            endif;
                        endif;

                        if ( $team->conference == "AFC" ): 
                            if ( $team->division == "North" ):
                                array_push( $afcNorth, $team->name );
                            elseif ( $team->division == "East" ):
                                array_push( $afcEast, $team->name );
                            elseif ( $team->division == "West" ):
                                array_push( $afcWest, $team->name );
                            else:
                                array_push( $afcSouth, $team->name );
                            endif;
                        endif;
                    }

                    //Display teams sorted by conference and division
                    echo '<div class="chalk-nfl">';
                        echo '<h2>National Football League (NFL)</h2>';
                            echo '<div class="chalk-nfc">';
                                echo '<table>';
                                    echo '<tr class="chalk-nfc-row">';
                                        echo '<th>NFC</th>';
                                    echo '</tr>';
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>NFC North</th>';
                                    echo '</tr>';
                            
                                        for ($i = 0; $i < count($nfcNorth); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $nfcNorth[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                            
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>NFC East</th>';
                                    echo '</tr>';
                            
                                        for ($i = 0; $i < count($nfcEast); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $nfcEast[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                            
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>NFC West</th>';
                                    echo '</tr>';       
                                        
                                        for ($i = 0; $i < count($nfcWest); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $nfcWest[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                            
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>NFC South</th>';
                                    echo '</tr>';
                                        
                                        for ($i = 0; $i < count($nfcSouth); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $nfcSouth[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                                echo '</table>';
                            echo '</div>';

                            echo '<div class="chalk-afc">';
                                echo '<table>';
                                    echo '<tr class="chalk-afc-row">';
                                        echo '<th>AFC</th>';
                                    echo '</tr>';
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>AFC North</th>';
                                    echo '</tr>';
                            
                                        for ($i = 0; $i < count($afcNorth); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $afcNorth[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                            
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>AFC East</th>';
                                    echo '</tr>';
                            
                                        for ($i = 0; $i < count($afcEast); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $afcEast[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                            
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>AFC West</th>';
                                    echo '</tr>';       
                                        for ($i = 0; $i < count($afcWest); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $afcWest[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }
                            
                                    echo '<tr class ="chalk-division">';
                                        echo '<th>AFC South</th>';
                                    echo '</tr>';
                                
                                        for ($i = 0; $i < count($afcSouth); $i++) {
                                            echo '<tr>';
                                                echo '<td>';
                                                    echo $afcSouth[$i];
                                                echo '</td>';
                                            echo '</tr>';
                                        }

                    
                                echo '</table>';
                            echo '</div>';
                    echo '</div>';
                }  

    } 

} 
             
    