
Name: app-mail-antivirus
Epoch: 1
Version: 2.0.0
Release: 1%{dist}
Summary: Mail Antivirus
License: GPLv3
Group: ClearOS/Apps
Source: %{name}-%{version}.tar.gz
Buildarch: noarch
Requires: %{name}-core = 1:%{version}-%{release}
Requires: app-base
Requires: app-antivirus

%description
An open-source antivirus and antimalware scanner for mail servers.

%package core
Summary: Mail Antivirus - Core
License: LGPLv3
Group: ClearOS/Libraries
Requires: app-base-core
Requires: amavisd-new
Requires: app-antivirus-core
Requires: app-mail-filter-core >= 1:1.6.5
Requires: app-smtp-core

%description core
An open-source antivirus and antimalware scanner for mail servers.

This package provides the core API and libraries.

%prep
%setup -q
%build

%install
mkdir -p -m 755 %{buildroot}/usr/clearos/apps/mail_antivirus
cp -r * %{buildroot}/usr/clearos/apps/mail_antivirus/


%post
logger -p local6.notice -t installer 'app-mail-antivirus - installing'

%post core
logger -p local6.notice -t installer 'app-mail-antivirus-core - installing'

if [ $1 -eq 1 ]; then
    [ -x /usr/clearos/apps/mail_antivirus/deploy/install ] && /usr/clearos/apps/mail_antivirus/deploy/install
fi

[ -x /usr/clearos/apps/mail_antivirus/deploy/upgrade ] && /usr/clearos/apps/mail_antivirus/deploy/upgrade

exit 0

%preun
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-mail-antivirus - uninstalling'
fi

%preun core
if [ $1 -eq 0 ]; then
    logger -p local6.notice -t installer 'app-mail-antivirus-core - uninstalling'
    [ -x /usr/clearos/apps/mail_antivirus/deploy/uninstall ] && /usr/clearos/apps/mail_antivirus/deploy/uninstall
fi

exit 0

%files
%defattr(-,root,root)
/usr/clearos/apps/mail_antivirus/controllers
/usr/clearos/apps/mail_antivirus/htdocs
/usr/clearos/apps/mail_antivirus/views

%files core
%defattr(-,root,root)
%exclude /usr/clearos/apps/mail_antivirus/packaging
%dir /usr/clearos/apps/mail_antivirus
/usr/clearos/apps/mail_antivirus/deploy
/usr/clearos/apps/mail_antivirus/language
