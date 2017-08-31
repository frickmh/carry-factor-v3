//findPlayerNames(chat) - Extract Player Names from a string.
//changeColors() - Toggle between Light and Dark color theme
//opggRegion(region) - Converts Riot API region to op.gg region

    function opggRegion(region) {
            var outputRegion;

            outputRegion = region == 'la1' ? 'lan' : region;
            outputRegion = region == 'la2' ? 'las' : region;

            outputRegion = outputRegion.replace(/[0-9]/g, '');

            return outputRegion;
          }

            function changeColors() {
                document.cookie = "darkScheme=" + document.getElementById('useDark').checked + "; expires=Thu, 18 Dec 2020 12:00:00 UTC;";


                if (document.getElementById('useDark').checked) {
                    document.getElementById('dark-styles').disabled = false;
                    document.getElementById('light-styles').disabled = true;
                } else {
                    document.getElementById('dark-styles').disabled = true;
                    document.getElementById('light-styles').disabled = false;
                }
            }

            console.log(document.getElementById('useDark'));
            console.log(getCookie('darkScheme'));

            if (getCookie('darkScheme') == 'true') {
                document.getElementById('useDark').checked = true;
                document.getElementById('dark-styles').disabled = false;
                document.getElementById('light-styles').disabled = true;
            } else {
                document.getElementById('useDark').checked = false;
                document.getElementById('dark-styles').disabled = true;
                document.getElementById('light-styles').disabled = false;
            }


            function findPlayerNames(chat) {
                var lobbyChatLines = chat.split(/\r?\n/);

                var playersList = [];

                for (i = 0; i < lobbyChatLines.length; i++) {
                      if (lobbyChatLines[i].indexOf('You are now in a chat room with your full champion select team.') > -1) {


                      } else if (lobbyChatLines[i].indexOf("A player did not lock in their pick or ban. Your group was returned to matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf("A player didn't accept the AFK check. Your group was returned to matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf("did not accept the AFK check. Your group was removed from matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf("cancelled matchmaking.") > -1) {


                      } else if (lobbyChatLines[i].indexOf('A player left champ select. Your group was returned to matchmaking.') > -1) {


                      } else if (lobbyChatLines[i].indexOf('You are now back in a chat room with just your premade.') > -1) {


                      } else if (lobbyChatLines[i].indexOf(':') > 0) {
                          var name = lobbyChatLines[i].split(':')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }


                      } else if (lobbyChatLines[i].indexOf(' joined the room.') > 0) {

                          var name = lobbyChatLines[i].split(' joined the room.')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' joined the lobby') > 0) {

                          var name = lobbyChatLines[i].split(' joined the lobby')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' a rejoint le salon') > 0) {

                          var name = lobbyChatLines[i].split(' a rejoint le salon')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }


                      } else if (lobbyChatLines[i].indexOf(' se unió a la sala') > 0) {
                                                        //Spanish
                          var name = lobbyChatLines[i].split(' se unió a la sala')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' entrou no saguão') > 0) {
                                                        //Spanish
                          var name = lobbyChatLines[i].split(' entrou no saguão')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' присоединился к лобби') > 0) {
                                                        //Spanish
                          var name = lobbyChatLines[i].split(' присоединился к лобби')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }


                      } else if (lobbyChatLines[i].indexOf(' everek lobiye katıldı') > 0) {
                                                        //Spanish
                          var name = lobbyChatLines[i].split(' everek lobiye katıldı')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].indexOf(' がロビーに参加しました') > 0) {
                                                        //Spanish
                          var name = lobbyChatLines[i].split(' がロビーに参加しました')[0].replace(/\s/g, '');

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);

                          }

                      } else if (lobbyChatLines[i].replace(/\s/g, '').length > 1){
                          var name = lobbyChatLines[i].replace(/\s/g, '');
                          //alert(name);
                          /*if (name.toUpperCase() === "LIQUIDHANDSOAP")
                          {
                              alert(name);
                          }*/

                          var upperCaseNames = playersList.map(function(value) {
                          return value.toUpperCase();
                          });

                          if (upperCaseNames.indexOf(name.toUpperCase()) < 0) {
                              playersList.push(name);
                          }
                          //playersList.push(name);
                      }


              }

              var params = '';

              for (i = 0; i < playersList.length; i++) {

                    params += playersList[i];


                    if (i < playersList.length - 1) {
                        params +=',';
                    } else {

                    }

              }

              return params;

            };


