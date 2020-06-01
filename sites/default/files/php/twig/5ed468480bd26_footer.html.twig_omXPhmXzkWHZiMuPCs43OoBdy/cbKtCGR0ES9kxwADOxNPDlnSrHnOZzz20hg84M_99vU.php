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

/* @basic/footer.html.twig */
class __TwigTemplate_983b31674b6ddabab8837c5969a0421372c0c6056d081ee34dd13797978831e4 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["trans" => 12, "set" => 28, "if" => 30, "for" => 44];
        $filters = ["escape" => 5];
        $functions = ["simplify_menu" => 28];

        try {
            $this->sandbox->checkSecurity(
                ['trans', 'set', 'if', 'for'],
                ['escape'],
                ['simplify_menu']
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
        echo "<footer id=\"footer\">
  <div class=\"container\">    
    <div class=\"footer-region info\">
        <figure class=\"logo\">
            <img src=\"/";
        // line 5
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null)), "html", null, true);
        echo "/images/logo-blanco.svg\" alt=\"Global Rheumatology\" width=\"200\" height=\"200\" />
        </figure>
        <p class=\"description\">
            Es un órgano de divulgación de la Liga Panamericana de Asociaciones de Reumatología (PANLAR). 
        </p>

        <div class=\"contact\">
            <span>";
        // line 12
        echo t("Contáctenos", array());
        echo ":</span>
            <a href=\"mailto:info@globalrheumpanlar.org\">info@globalrheumpanlar.org</a>
        </div>

        <div class=\"social\">
            <nav class=\"networks\">
                <ul>
                  <li class=\"fb\">Facebook</li>
                  <li class=\"tw\">Twitter</li>
                  <li class=\"lk\">Linkedin</li>
                </ul>
            </nav>       
        </div>
        
    </div>
    <div class=\"footer-region links\">
        ";
        // line 28
        $context["items"] = call_user_func_array($this->env->getFunction('simplify_menu')->getCallable(), ["menu-footer"]);
        // line 29
        echo "        <ul class=\"sections\">
            ";
        // line 30
        if ((($context["logged_in"] ?? null) != true)) {
            // line 31
            echo "                <li class=\" navigation__item\">
                    <a href=\"/user/login\" class=\"\">";
            // line 32
            echo t("INICIAR SESIÓN", array());
            echo "</a>
                </li>
            ";
        }
        // line 35
        echo "
            ";
        // line 36
        if (($context["logged_in"] ?? null)) {
            // line 37
            echo "                <li class=\" navigation__item\">
                    <a href=\"/new/send/manuscrito\" class=\"\">";
            // line 38
            echo t("PUBLICAR", array());
            echo "</a>
                </li>
                <li class=\" navigation__item\">
                    <a href=\"/show/saved/content\" class=\"\">";
            // line 41
            echo t("ARTÍCULOS GUARDADOS", array());
            echo "</a>
                </li>
            ";
        }
        // line 44
        echo "            ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["items"] ?? null), "menu_tree", []));
        foreach ($context['_seq'] as $context["_key"] => $context["menu_item"]) {
            // line 45
            echo "                <li class=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["item_class"] ?? null)), "html", null, true);
            echo " navigation_item\">
                    <a href=\"";
            // line 46
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "url", [])), "html", null, true);
            echo "\" class=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link_class"] ?? null)), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "text", [])), "html", null, true);
            echo "</a>
                </li>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "        </ul>
        <a href=\"#\" class=\"privacy\">";
        // line 50
        echo t("Política de privacidad", array());
        echo "</a>
    </div>
    <div class=\"footer-region newsletter\">
      <h3>Suscríbase</h3>
      <h2>";
        // line 54
        echo t("Obtenga las últimas noticias directamente a su correo", array());
        echo "</h2>
      <div>
        <input type=\"text\" placeholder=\"ingrese su correo\">
        <button>";
        // line 57
        echo t("Subscribirse", array());
        echo "</button>
      </div>
    </div>    
    <div class=\"footer-region copy\">
      <figure class=\"logo-iv\">
        <img src=\"/";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null)), "html", null, true);
        echo "/images/inteligencia-viral.webp\" alt=\"Global Rheumatology\" width=\"200\" height=\"200\" />
      </figure>
      <p class=\"copy-text\">Diseño & desarrollo por Inteligencia Viral <br> &copy;2019 Global Rheumatology by Panlar.</p>
    </div>
  </div>
  <nav id=\"menu-fixed\" class=\"mobile\">
      <a class=\"icon home\" href=\"/\">Inicio</a>
      <a class=\"icon search\" href=\"/global-rheumatology/search/content\">Buscar</a>
      <a class=\"icon multimedia\" href=\"/secciones/26/multimedia\">Multimedia</a>
      <a class=\"icon save\" href=\"/show/saved/content\">Guardados</a>
      <a class=\"icon perfil\" href=\"/user\">Perfil</a>
  </nav>
</footer>";
    }

    public function getTemplateName()
    {
        return "@basic/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 62,  165 => 57,  159 => 54,  152 => 50,  149 => 49,  136 => 46,  131 => 45,  126 => 44,  120 => 41,  114 => 38,  111 => 37,  109 => 36,  106 => 35,  100 => 32,  97 => 31,  95 => 30,  92 => 29,  90 => 28,  71 => 12,  61 => 5,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@basic/footer.html.twig", "/Applications/MAMP/htdocs/Global-Rheumatology/themes/custom/basic/templates/footer.html.twig");
    }
}
