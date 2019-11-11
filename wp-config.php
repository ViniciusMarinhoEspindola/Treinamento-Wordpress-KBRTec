<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress_crud' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',:oM6%:r4&g3I41Fe>BrCY-T3TIJ)lP}JVM84{EJ/.N^)$NavNxe[&^[8fgBBI&}' );
define( 'SECURE_AUTH_KEY',  'Vi26Ne5n@mW6GSXGiV0vn^*f0IjVNX6Ii{ESi@C4ae39XW]KdY =`&PR /G6FAOH' );
define( 'LOGGED_IN_KEY',    'L__) ot~zzzQzex[)m6FjbrD3!!|9yv~FN2U(@-=Fq2;-;rCE~2e&=wt1NW? <2]' );
define( 'NONCE_KEY',        'E;~)MtU^n}s{e~QtpZfn/5T-~?f-N{l&FyH]1X1O_v|n@s4Vk^qr|GTmJgOGmQ3G' );
define( 'AUTH_SALT',        ']xP+r[Kr[MP40R|ZTMN^p|<F`HKi6.l2>sT$OMu1!@0boYci~]2TI)no]bQ~U0L+' );
define( 'SECURE_AUTH_SALT', '7v]Y6L.OQFUZ|[Hpd%L^%mGt.~$fyTa8%hFSa:9I?To:b73V9gJi;qH0[$fAw|[`' );
define( 'LOGGED_IN_SALT',   'WGm|Bp=]^,5BU-5z[%oVr?<QncFu),3@N?{<_:wj9|0n$JUs7rY6{| q&KJ8UN J' );
define( 'NONCE_SALT',       'H%pYZVv6JK]YlVl}E/Da8O<g5<czLv%T_fVOuaE.v3y^v#3z[Qn6~HuF294%B^2,' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
