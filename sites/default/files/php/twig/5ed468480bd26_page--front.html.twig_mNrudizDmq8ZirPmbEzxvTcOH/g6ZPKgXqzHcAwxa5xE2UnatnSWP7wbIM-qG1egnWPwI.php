<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/basic/templates/page--front.html.twig */
class __TwigTemplate_b47fb366964b1a04f002395ee058088b8aa22f75db66c3b646cf7f1b97882729 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["trans" => 15, "if" => 22];
        $filters = ["escape" => 5];
        $functions = ["drupal_view" => 5, "drupal_field" => 14];

        try {
            $this->sandbox->checkSecurity(
                ['trans', 'if'],
                ['escape'],
                ['drupal_view', 'drupal_field']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!-- ______________________ MAIN _______________________ -->
<div id=\"main\">
    <div class=\"container\">
        <div class=\"first_new\">
            ";
        // line 5
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("home", "block_1"), "html", null, true);
        echo "
            <div class=\"scroll arrow-down\"></div>
        </div>
    </div>
    <!-- /.container -->

    <div class=\"container\">
        <div class=\"send_article\">
            <div class=\"block-title\">
            <h3>";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalField("title", "node", 208), "html", null, true);
        echo "</h3>
                <!--<h3>";
        // line 15
        echo t("Envie su artículo", array());
        echo "</h3>-->
            </div>
            <div>
                ";
        // line 18
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalField("body", "node", 208), "html", null, true);
        echo "
            </div>

            <!--<p>Sea parte de Global Rheumalology enviando sus contenidos. <br> Revise en línea el estado de sus publicaciones y revisiones. </p>-->
            <button class=\"send-article new-article ";
        // line 22
        if (($this->getAttribute(($context["user"] ?? null), "id", []) != 0)) {
            echo "authentificate";
        } else {
            echo "anonime";
        }
        echo "\" data-heref=\"";
        if (($this->getAttribute(($context["user"] ?? null), "id", []) != 0)) {
            echo " /new/send/manuscrito ";
        } else {
            echo "  ";
        }
        echo "\">";
        echo t("Enviar artículo", array());
        echo " </button>
        </div>
    </div>
    <!-- /.container -->

    <div class=\"container\">
        <div class=\"last_news\">
            <div class=\"block-title\">
                <h3>";
        // line 30
        echo t("Últimos artículos", array());
        echo "</h3>
            </div>
            <dd>";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("home", "block_3"), "html", null, true);
        echo "</dd>
        </div>
    </div>
    <!-- /.container -->

    <div class=\"container\">
        <div class=\"most_read\">
            <div class=\"top\">
                <div class=\"left\">
                    <div class=\"block-title\">
                        <h3>";
        // line 42
        echo t("Tendencias", array());
        echo "</h3>
                    </div>
                </div>
                <div class=\"right\">
                    <span id=\"read\" class=\"more-read active\">";
        // line 46
        echo t("Lo más visto", array());
        echo "</span>
                    <hr>
                    <span id=\"shared\" class=\"more-shared\">";
        // line 48
        echo t("Lo más compartido", array());
        echo "</span>
                </div>
            </div>
            <div class=\"bottom\">
                <div class=\"view_news more-read active\">
                    <dd>";
        // line 53
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("home", "block_4"), "html", null, true);
        echo "</dd>
                </div>
                <div class=\"view_news more-shared\">
                    <dd>";
        // line 56
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("home", "block_5"), "html", null, true);
        echo "</dd>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <div class=\"container\">
        <div class=\"magazine_news\">
            <div class=\"block-title\">
                <h3>";
        // line 66
        echo t("Magazine", array());
        echo "</h3>
            </div>
            <dd>";
        // line 68
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("home", "block_6"), "html", null, true);
        echo "</dd>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- /#main -->";
    }

    public function getTemplateName()
    {
        return "themes/custom/basic/templates/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 68,  170 => 66,  157 => 56,  151 => 53,  143 => 48,  138 => 46,  131 => 42,  118 => 32,  113 => 30,  90 => 22,  83 => 18,  77 => 15,  73 => 14,  61 => 5,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/basic/templates/page--front.html.twig", "/Applications/MAMP/htdocs/Global-Rheumatology/themes/custom/basic/templates/page--front.html.twig");
    }
}
