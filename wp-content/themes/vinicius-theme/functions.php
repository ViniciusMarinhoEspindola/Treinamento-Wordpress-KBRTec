<?php 
// -------------------------------------------------
// - REMOVER itens do menu de navegação à esquerda -
// -------------------------------------------------

function pc_remove_links_menu() {
 
     global $menu;
 
     remove_menu_page ('index.php'); // Painel
     remove_menu_page ('upload.php'); // Mídia
     remove_menu_page ('edit.php'); // Posts
     remove_menu_page ('link-manager.php'); // Links Permanentes
     remove_menu_page ('themes.php'); // Temas
     remove_menu_page ('edit-comments.php'); // Comentarios
     remove_menu_page ('edit.php?post_type=page'); // Páginas
     remove_menu_page ('edit.php?post_type=acf-field-group'); // Campos personalizados
     remove_menu_page ('plugins.php'); // Plugins
     remove_menu_page ('users.php'); // Usuarios
     remove_menu_page ('options-general.php');  // Configurações
     remove_menu_page ('tools.php');  // Ferramentas
}
 
add_action ('admin_menu', 'pc_remove_links_menu');



// ----------------------------
// --  REMOVER ITENS SUB MENUS  --
// ----------------------------
 
function pc_remove_submenus() {
 
    global $submenu;
   
    unset($submenu['themes.php'][5]); // Remove 'Temas'.
    unset($submenu['options-general.php'][15]); // Remove 'Escrita'.
    unset($submenu['options-general.php'][25]); // Remove 'Discussão'.
    unset($submenu['tools.php'][5]); // Remove 'Disponíveis'.
    unset($submenu['tools.php'][10]); // Remove 'Importar'.
    unset($submenu['tools.php'][15]); // Remove 'Exportar'.
  }
   
  add_action( 'admin_menu', 'pc_remove_submenus' );
   
  // Remove Link Aparência > Editor 
   
  function remove_editor_menu() {
    remove_action('admin_menu', '_add_themes_utility_last', 101);
  }
   
  add_action('_admin_menu', 'remove_editor_menu', 1);
   
  // Remove Link Plugin > Editor
   
  function pc_remove_plugin_editor() {
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
  }
   
  add_action('admin_init', 'pc_remove_plugin_editor');
  

  
/* Criando a pagina de gerenciamento de treinamentos */


  add_theme_support('post-thumbnails');

  function pc_create_post_treinamento()
  {
   $singularName = 'Treinamento';
   $pluralName = 'Treinamentos';
   $labels = array (
       'name' => $pluralName,
       'singular_name' => $singularName,
       'add_new_item' => 'Adicionar ' . $singularName,
       'edit_item' => 'Editar ' . $singularName,
       'new_item' => 'Novo ' . $singularName,
       'view_item' => 'Visualizar ' . $singularName,
       'view_items' => 'Visualizar ' . $pluralName
   );
   
   $supports = array (
    'title',
    'editor',
    'thumbnail'
   );
   
   $args = array(
       'public' => true,
       'labels' => $labels,
       'description' => 'Treinamentos disponíveis para as pessoas.',
       'menu_position' => 5,
       'menu_icon' => 'dashicons-welcome-learn-more',
       'supports' => $supports
   );
   register_post_type('treinamento', $args);
  }
  add_action('init', 'pc_create_post_treinamento');


  /* Criando a página de gerenciamento de inscritos */
  function inscritos_admin() {
      add_menu_page( 'Inscritos', 'Gerenciamento de inscritos', 'manage_options', 'treinamentos', 'show_menu_inscritos', 'dashicons-admin-users' );
  }
  add_action('admin_menu', 'inscritos_admin');
  function show_menu_inscritos () {
    require_once 'inscritos.php';
  }
  
  // Colocar botão de vizualizar inscritos na pag de treinamentos
  add_filter('manage_posts_columns', 'posts_columns');
  add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

  function posts_columns($defaults){
    $defaults['vizualizar_user'] = __('Vizualizar');
    return $defaults;
  }
     
  function posts_custom_columns($column_name, $id){
    if($column_name === 'vizualizar_user'){
      
      echo "<button style='padding: 0.375rem 0.75rem;border-radius: 0.25rem;font-size: 1rem;color: #fff !important;background-color: #f0ad4e;border-color: #f0ad4e;border: 1px solid transparent;text-decoration: none;'><a href='./admin.php?page=treinamentos&id=".$id."' >Vizualizar</a></button>";
    }
  }

  // Cadastrar os inscritos
  function cadastrar_inscritos($pagamento = '', $status = '')
  {
    global $wpdb;
    $wpdb->insert( 
        'usuarios_wp', 
        array( 
            'nome' => $_POST['nome'], 
            'nascimento' => $_POST['nascimento'],
            'cpf' => $_POST['cpf'], 
            'email' => $_POST['email'],
            'cep' => $_POST['cep'], 
            'endereco' => $_POST['endereco'].', Número '.$_POST['numero'].', complemento '.$_POST['complemento'],
            'bairro' => $_POST['bairro'], 
            'cidade' => $_POST['cidade'],
            'estado' => $_POST['estado'], 
            'telefone' => $_POST['telefone'],
            'celular' => $_POST['celular'], 
            'treinamento_id' => $_POST['treinamento_id'],
            'dt_inscricao' => date("Y-m-d") ,
            'cd_pagamento' => $pagamento,
            'status_pagamento' => $status
        )
    );

    echo "Cadastrado com sucesso!";
  }

  // Excluir os inscritos
  function excluir_inscrito()
  {
    global $wpdb;
    $wpdb->delete( 'usuarios_wp', array( 'id_usuario' => $_POST['usuario'] ) );

    echo "Deletado com sucesso!";
  }

  function wordpress_pagination($items = null)
  {
    $prev_arrow = is_rtl() ? '→' : '←';
    $next_arrow = is_rtl() ? '←' : '→';
    global $wp_query;
    if ($items) {
        $total = $items->max_num_pages;
    } else {
        $total = $wp_query->max_num_pages;
    }
    $big = 999999999; // need an unlikely integer
    if ($total >= 1) {
        if (!$current_page = get_query_var('paged'))
            $current_page = 1;
        if (get_option('permalink_structure')) {
            $format = 'page/%#%/';
        } else {
            $format = '&paged=%#%';
        }
        echo paginate_links(array(
            'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'        => $format,
            'current'        => max(1, get_query_var('paged')),
            'total'         => $total,
            'type'             => 'list',
            'prev_text'        => $prev_arrow,
            'next_text'        => $next_arrow,
        ));
    }
  }


  function unique_value($campo) {
      global $wpdb;
      $results = $wpdb->get_results("SELECT * FROM usuarios_wp WHERE $campo = '".$_POST[$campo]."' AND treinamento_id = '".$_POST['treinamento_id']."'");
      if($wpdb->num_rows !== 0){
        return False;
      }
      return True;
  }

  function preenche_form() {
    return array( 
      'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '', 
      'nascimento' => (isset($_POST['nascimento'])) ? $_POST['nascimento'] : '',
      'cpf' => (isset($_POST['cpf'])) ? $_POST['cpf'] : '', 
      'email' => (isset($_POST['email'])) ? $_POST['email'] : '',
      'cep' => (isset($_POST['cep'])) ? $_POST['cep'] : '', 
      'endereco' => (isset($_POST['endereco'])) ? $_POST['endereco'] : '',
      'numero' => (isset($_POST['numero'])) ? $_POST['numero'] : '',
      'complemento' => (isset($_POST['complemento'])) ? $_POST['complemento'] : '',
      'bairro' => (isset($_POST['bairro'])) ? $_POST['bairro'] : '', 
      'cidade' =>(isset($_POST['cidade'])) ? $_POST['cidade'] : '',
      'estado' => (isset($_POST['estado'])) ? $_POST['estado'] : '', 
      'telefone' => (isset($_POST['telefone'])) ? $_POST['telefone'] : '',
      'celular' => (isset($_POST['celular'])) ? $_POST['celular'] : '', 
    );
  }