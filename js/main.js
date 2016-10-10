// Inicializa script
$(document).ready(function() {
    views.init();
});

/**
 * Objeto Literal principal para as views (vistas). Esse objeto/classe é
 * responsável por coordenar e integrar os diferentes objetos client-side que
 * executam tarefas tais como montar widgets, estrutrar layout, cordenar
 * da apresentação, entre outros.
 *
 * @author Renato Martins <renato@rd2m.com>
 */
views = {

    /**
     * Inicializa objeto
     *
     * @returns void
     */
    init: function() {

        views.setDefaults();
        views.assignsEvents();
        views.photos.init();
    },

    /**
     * Adiciona eventos gerais de todas as views.
     *
     * @returns void
     */
    assignsEvents: function() {},

    /**
     * Configura valores padrão.
     *
     * @returns void
     */
    setDefaults: function() {},

    /**
     * Objeto Literal photos.
     */
    photos: {

        /**
         * Estado inicial da tela de fotos.
         */
        init: function() {

            // Atribui eventos para controlar visibilidade do box de cadastrar nova foto
            $('.js-btn-add').click(function(e) { e.preventDefault(); views.photos.toggleFloatBox(); });
            $('.float-box').click(function(e) { e.stopPropagation(); });
            $('.js-btn-add-submit').click(function(e) { if( $('.js-input-file').val() == '' ) { e.preventDefault(); $('.js-input-file').addClass('is-empty'); } });
            $('.js-btn-add-reset').click(function() { $(document).click(); });
            $('.js-input-file').change(function(){ $('.js-input-file').removeClass('is-empty'); });
        },

        /**
         * Controla estado do box de cadastrar nova foto.
         *
         * @returns void
         */
        toggleFloatBox: function() {

            // Faz referência ao box
            var $floatBox = $('.float-box');

            // Se o box não estiver visível
            if (!$floatBox.is(':visible')) {

                // Exibe box
                $floatBox.show();

                // Seta evento para ocultar o box
                setTimeout(function() {
                    $(document).one("click", function() {

                        // Oculta box
                        $floatBox.hide();

                        // Retira erros de validação client-side
                        $('.js-input-file').removeClass('is-empty');
                    })
                }, 1);
            }
        }
    }
}
