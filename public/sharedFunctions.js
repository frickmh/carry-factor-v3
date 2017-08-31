/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var findPlayernames = function findPlayerNames(chat) {
    var lobbyChatLines = chat.split(/\r?\n/);

    var playersList = [];

    for (i = 0; i < lobbyChatLines.length; i++) {
          //alert(lobbyChatLines[i]);


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