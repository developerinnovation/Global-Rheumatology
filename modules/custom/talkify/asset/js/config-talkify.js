
(function ($, Drupal, drupalSettings) {

    Drupal.behaviors.my_custom_behavior = {
        attach: function (context, settings) {
            
            var api_key_talkify = drupalSettings.api_key_talkify;
            var host_talkify = drupalSettings.host_talkify;
            var speech_baseUrl_talkify = drupalSettings.speech_baseUrl_talkify;
            var voice_talkify = drupalSettings.voice_talkify;
            var control_audio_position = drupalSettings.position_talkify;
            
            talkify.config = {
                debug: false, //true to turn on debug print outs
                useSsml: true, //true to turn on automatic HTML to SSML translation. This should give a smoother reading voice (https://en.wikipedia.org/wiki/Speech_Synthesis_Markup_Language)
                maximumTextLength: 3000, //texts exceeding this limit will be splitted into multiple requests
                remoteService: {
                    host : host_talkify,
                    speechBaseUrl : speech_baseUrl_talkify,
                    apiKey : api_key_talkify,
                    active: true //True to use Talkifys language engine and hosted voices. False only works for Html5Player.
                },
                ui:
                {
                    audioControls: { //If enabled, replaces the built in audio controls. Especially good for the Web Speech API bits
                        enabled: false,
                        container: control_audio_position,
                        voicepicker: {
                            enabled: true,
                            filter: {
                                byClass: [], 
                                byCulture: ["es-ES", "es-MX"],
                                byLanguage: ["English", "Spanish"],
                                bySpecialCharacters : ["ñ", "¿"],
                            }
                        }
                    }
                },
                keyboardCommands: { //Ctrl + command
                    enabled: false,
                    commands: { // Configure your own keys for the supported commands
                        playPause: 32,
                        next: 39,
                        previous: 37
                    }
                },
                voiceCommands: {
                    enabled: false,
                    keyboardActivation: { //Ctrl + command
                        enabled: true,
                        key: 77
                    },
                    commands: { // Configure your own phrases for the supported commands
                        playPause: ["play", "pause", "stop", "start"],
                        next: ["play next", "next"],
                        previous: ["play previous", "previous", "back", "go back"]
                    }
                },
                formReader: {
                    voice: voice_talkify, //TTS voice name if remote service otherwise Web Speech API voice object
                    rate: 0, //See possible values for each tyoe of player down below
                    remoteService: true,
                    //Below is the default texts for the form.
                    requiredText: "This field is required",
                    valueText: "You have entered {value} as: {label}.",
                    selectedText: "You have selected {label}.",
                    notSelectedText: "{label} is not selected."
                },
            }
        }
    }

})(jQuery, Drupal, drupalSettings);

$(document).ready(function() {
    var text = $('body #main .right').text().trim();
    var player = null;
    $('.buttons .sound').click(function() {
        $(this).removeClass("active");
        $(".control-audio").addClass("active");
        player = new talkify.TtsPlayer();
        player.setRate = 0;
        player.playText(text);
        var intervel = setInterval(function(){ 
            if(!player.isPlaying()){
                $(".buttons .control-audio .stop").click();
                clearInterval(intervel);
            }
        }, 60000);
    });

    $(".buttons .control-audio .stop").click(function()  {
        $(".control-audio").removeClass("active");
        $(".buttons .control-audio .pause").addClass("active");
        $(".top .buttons .sound").addClass("active");
        $(".buttons .control-audio .play").removeClass("active");
        player.dispose();
    });

    $(".buttons .control-audio .pause").click(function()  {
        $(this).removeClass("active");
        $(".buttons .control-audio .play").addClass("active");
        player.pause();
    });

    $(".buttons .control-audio .play").click(function()  {
        $(this).removeClass("active");
        $(".buttons .control-audio .pause").addClass("active");
        player.play();
    });
    

});


