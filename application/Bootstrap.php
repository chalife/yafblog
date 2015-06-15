<?php
/**
 * 所有在bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 *  * 调用的次序, 和申明的次序相同
 *   */
class Bootstrap extends Yaf_Bootstrap_Abstract{
	/**
	 ** 注册一个插件
	 ** 插件的目录是在application_directory/plugins
	 *                                                    */
	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
		$user = new UserPlugin();
		$dispatcher->registerPlugin($user);
	}

	/**
	 * 添加配置中的路由
	 **/
	public function _initRoute(Yaf_Dispatcher $dispatcher) {
		$router = Yaf_Dispatcher::getInstance()->getRouter();
		$router->addConfig(Yaf_Registry::get("config")->routes);
		var_dump(Yaf_Registry::get("config"));die;
		/**
		 *                  * 添加一个路由
		 *                                   */
		$route  = new Yaf_Route_Rewrite(
			"/product/list/:id/",
			array(
				"controller" => "product",
				"action"         => "info",
			)
		);

		$router->addRoute('dummy', $route);
	}

	/**
	 *   * 自定义视图引擎
	 *     */
	public function _initSmarty(Yaf_Dispatcher $dispatcher) {
		$smarty = new Smarty_Adapter(null, Yaf_Registry::get("config")->get("smarty"));
		Yaf_Dispatcher::getInstance()->setView($smarty);
	}
}
