                        function openMotorTable() {
                            var motorTable = document.getElementById("motorTable");
                            var motorselected = document.getElementById("motorselected");
                            if (motorTable.style.display == "none"){
                                motorTable.style.display = "block";
                                ESCTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                batteriTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "none";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="block";

                                dynamicMotorTable.style.display="none";
                                dynamicESCTable.style.display="none";
                                dynamicKontrollbrettTable.style.display="none";
                                dynamicPropellTable.style.display="none";
                                dynamicBatteriTable.style.display="none";
                            }
                            else{
                                motorTable.style.display = "none";
                                motorselected.style.display="none";

                                dynamicMotorTable.style.display="block";
                                dynamicESCTable.style.display="block";
                                dynamicKontrollbrettTable.style.display="block";
                                dynamicPropellTable.style.display="block";
                                dynamicBatteriTable.style.display="block";
                            }
                        }

                        function openESCTable() {
                            var ESCTable = document.getElementById("ESCTable");
                            var escselected = document.getElementById("escselected"); 
                            if (ESCTable.style.display == "none"){
                                ESCTable.style.display = "block";
                                motorTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                batteriTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "none";
                                escselected.style.display="block";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="none";

                                dynamicMotorTable.style.display="none";
                                dynamicESCTable.style.display="none";
                                dynamicKontrollbrettTable.style.display="none";
                                dynamicPropellTable.style.display="none";
                                dynamicBatteriTable.style.display="none";
                            }
                            else{
                                ESCTable.style.display = "none";
                                escselected.style.display="none";

                                dynamicMotorTable.style.display="block";
                                dynamicESCTable.style.display="block";
                                dynamicKontrollbrettTable.style.display="block";
                                dynamicPropellTable.style.display="block";
                                dynamicBatteriTable.style.display="block";
                            }
                        }

                        function openKontrollbrettTable() {
                            var kontrollbrettTable = document.getElementById("kontrollbrettTable");
                            var kontrollbrettselected = document.getElementById("kontrollbrettselected");
                            if (kontrollbrettTable.style.display == "none"){
                                kontrollbrettTable.style.display = "block";
                                ESCTable.style.display = "none";
                                motorTable.style.display = "none";
                                batteriTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "none";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="block";
                                motorselected.style.display="none";

                                dynamicMotorTable.style.display="none";
                                dynamicESCTable.style.display="none";
                                dynamicKontrollbrettTable.style.display="none";
                                dynamicPropellTable.style.display="none";
                                dynamicBatteriTable.style.display="none";
                            }
                            else{
                                kontrollbrettTable.style.display = "none";
                                kontrollbrettselected.style.display="none";

                                dynamicMotorTable.style.display="block";
                                dynamicESCTable.style.display="block";
                                dynamicKontrollbrettTable.style.display="block";
                                dynamicPropellTable.style.display="block";
                                dynamicBatteriTable.style.display="block";
                            }
                        }

                        function openPropellTable() {
                            var propellTable = document.getElementById("propellTable");
                            var propellselected = document.getElementById("propellselected");
                            if (propellTable.style.display == "none"){
                                propellTable.style.display = "block";
                                ESCTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                batteriTable.style.display = "none";
                                motorTable.style.display = "none";

                                propellselected.style.display="block";
                                batteriselected.style.display = "none";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="none";

                                dynamicMotorTable.style.display="none";
                                dynamicESCTable.style.display="none";
                                dynamicKontrollbrettTable.style.display="none";
                                dynamicPropellTable.style.display="none";
                                dynamicBatteriTable.style.display="none";
                            }
                            else{
                                propellTable.style.display = "none";
                                propellselected.style.display="none";

                                dynamicMotorTable.style.display="block";
                                dynamicESCTable.style.display="block";
                                dynamicKontrollbrettTable.style.display="block";
                                dynamicPropellTable.style.display="block";
                                dynamicBatteriTable.style.display="block";
                            }
                        }

                        function openBatteriTable() {
                            var batteriTable = document.getElementById("batteriTable");
                            var batteriselected = document.getElementById("batteriselected");
                            if (batteriTable.style.display == "none"){
                                batteriTable.style.display = "block";
                                ESCTable.style.display = "none";
                                kontrollbrettTable.style.display = "none";
                                motorTable.style.display = "none";
                                propellTable.style.display = "none";

                                propellselected.style.display="none";
                                batteriselected.style.display = "block";
                                escselected.style.display="none";
                                kontrollbrettselected.style.display="none";
                                motorselected.style.display="none";

                                dynamicMotorTable.style.display="none";
                                dynamicESCTable.style.display="none";
                                dynamicKontrollbrettTable.style.display="none";
                                dynamicPropellTable.style.display="none";
                                dynamicBatteriTable.style.display="none";
                            }
                            else{
                                batteriTable.style.display = "none";
                                batteriselected.style.display = "none";

                                dynamicMotorTable.style.display="block";
                                dynamicESCTable.style.display="block";
                                dynamicKontrollbrettTable.style.display="block";
                                dynamicPropellTable.style.display="block";
                                dynamicBatteriTable.style.display="block";
                            }
                        }