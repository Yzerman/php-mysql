
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

	config.vm.box = "precise32"
	config.vm.box_url = "http://files.vagrantup.com/precise32.box"

	config.vm.provision :shell, :path => "bootstrap.sh"
	
	config.vm.network "forwarded_port", guest: 80, host: 8080
	config.vm.network "forwarded_port", guest: 8081, host: 8081
	
	config.vm.provider :virtualbox do |vbox|
		vbox.customize ["modifyvm", :id, "--memory", 1024]
		vbox.customize ["modifyvm", :id, "--name", "dev1"]
		vbox.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
	end
	
	config.vm.box = "dev1"
	config.vm.hostname = "dev1"
	
end
