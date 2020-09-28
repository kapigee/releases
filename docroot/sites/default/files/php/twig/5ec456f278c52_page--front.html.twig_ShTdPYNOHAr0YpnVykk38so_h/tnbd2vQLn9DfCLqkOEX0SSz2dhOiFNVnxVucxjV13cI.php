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

/* themes/custom/ucla_apigee_portal/templates/layout/page--front.html.twig */
class __TwigTemplate_798add07798dffb85b3c7cab844fe25ec9eb06167fe016bf12cd91963855fed9 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 62];
        $filters = ["escape" => 51, "join" => 63, "render" => 98];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'join', 'render'],
                []
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
        // line 45
        echo "
<div class=\"l-page\">

 <header class=\"header header--flush\" role=\"banner\">
    <div class=\"header__container\">
      <div class=\"header__logo\">
        ";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header_logo", [])), "html", null, true);
        echo "
      </div>
      <div class=\"header__right\">
        <a class=\"hamburger hamburger--mobile\" tabindex=\"0\" aria-label=\"Open mobile menu\"><span class=\"hamburger__icon\"></span></a>
        ";
        // line 55
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "navigation", [])), "html", null, true);
        echo "
      </div>
    </div>
  </header>

  <main class=\"l-main\">
    <a id=\"main-content\" tabindex=\"-1\"></a>";
        // line 62
        echo "      ";
        if ($this->getAttribute(($context["page"] ?? null), "front_top_content", [])) {
            // line 63
            echo "     <div class=\"l-container ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter($this->sandbox->ensureToStringAllowed(($context["layout_classes"] ?? null)), " "), "html", null, true);
            echo "\">
      <div class=\"l-content\">
          ";
            // line 65
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "front_top_content", [])), "html", null, true);
            echo "
        </div>
     </div>
    ";
        }
        // line 69
        echo "    
    ";
        // line 70
        if ($this->getAttribute(($context["page"] ?? null), "full_width", [])) {
            // line 71
            echo "    <div class=\"full-width\">
     <div class=\"l-container u-space-mb\">
        ";
            // line 73
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "full_width", [])), "html", null, true);
            echo "
      </div>
     </div>
    ";
        }
        // line 77
        echo "
   

    <div class=\"l-container ";
        // line 80
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter($this->sandbox->ensureToStringAllowed(($context["layout_classes"] ?? null)), " "), "html", null, true);
        echo "\">
      ";
        // line 81
        if ( !($context["is_page"] ?? null)) {
            // line 82
            echo "        <div class=\"l-title\">
          ";
            // line 83
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "title", [])), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 86
        echo "
      <div class=\"l-content\">
       ";
        // line 88
        if ($this->getAttribute(($context["page"] ?? null), "pre_content", [])) {
            // line 89
            echo "        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "pre_content", [])), "html", null, true);
            echo "
       ";
        }
        // line 91
        echo "        ";
        if ($this->getAttribute(($context["page"] ?? null), "message", [])) {
            // line 92
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "message", [])), "html", null, true);
            echo "
        ";
        }
        // line 94
        echo "        ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
      </div>

      ";
        // line 97
        if ( !($context["is_page"] ?? null)) {
            // line 98
            echo "        ";
            if ($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "sidebar_first", []))) {
                // line 99
                echo "          <aside class=\"l-sidebar-first\" role=\"complementary\">
            ";
                // line 100
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
                echo "
          </aside>
        ";
            }
            // line 103
            echo "
        ";
            // line 104
            if ($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->getAttribute(($context["page"] ?? null), "sidebar_second", []))) {
                // line 105
                echo "          <aside class=\"l-sidebar-second\" role=\"complementary\">
            ";
                // line 106
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
                echo "
          </aside>
        ";
            }
            // line 109
            echo "      ";
        }
        // line 110
        echo "    </div>
  </main>

  <footer class=\"footer\" role=\"contentinfo\">

    ";
        // line 115
        if ($this->getAttribute(($context["page"] ?? null), "full_width_bottom", [])) {
            // line 116
            echo "      <div class=\"panel panel--flush\">
        ";
            // line 117
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "full_width_bottom", [])), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 120
        echo "
    <div class=\"footer__info\">
      <div class=\"l-container\">
        <div class=\"l-footer\">

          ";
        // line 125
        if ($this->getAttribute(($context["page"] ?? null), "footer_left", [])) {
            // line 126
            echo "          <div class=\"l-footer__info panel panel--transparent\">
            ";
            // line 127
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_left", [])), "html", null, true);
            echo "
          </div>
          ";
        }
        // line 130
        echo "
          ";
        // line 131
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_right", [])), "html", null, true);
        echo "
        </div>

      </div>
    </div>   
  </footer>

</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/ucla_apigee_portal/templates/layout/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 131,  226 => 130,  220 => 127,  217 => 126,  215 => 125,  208 => 120,  202 => 117,  199 => 116,  197 => 115,  190 => 110,  187 => 109,  181 => 106,  178 => 105,  176 => 104,  173 => 103,  167 => 100,  164 => 99,  161 => 98,  159 => 97,  152 => 94,  146 => 92,  143 => 91,  137 => 89,  135 => 88,  131 => 86,  125 => 83,  122 => 82,  120 => 81,  116 => 80,  111 => 77,  104 => 73,  100 => 71,  98 => 70,  95 => 69,  88 => 65,  82 => 63,  79 => 62,  70 => 55,  63 => 51,  55 => 45,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/ucla_apigee_portal/templates/layout/page--front.html.twig", "/Users/kthotti/Sites/devdesktop/apigee-dev/docroot/themes/custom/ucla_apigee_portal/templates/layout/page--front.html.twig");
    }
}
